<?php

namespace Botble\Stream\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Stream\Repositories\Interfaces\StreamInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Stream\Models\Stream;

class StreamTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * StreamTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param StreamInterface $streamRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, StreamInterface $streamRepository)
    {
        $this->repository = $streamRepository;
        $this->setOption('id', 'table-plugins-stream');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['stream.edit', 'stream.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     * @since 2.1
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function ($item) {
                if (!Auth::user()->hasPermission('stream.edit')) {
                    return $item->name;
                }
                return anchor_link(route('stream.edit', $item->id), $item->name);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return table_actions('stream.edit', 'stream.destroy', $item);
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Get the query object to be processed by table.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     * @since 2.1
     */
    public function query()
    {
        $model = $this->repository->getModel();
        $query = $model->select([
            'streams.id',
            'streams.name',
            'streams.created_at',
            'streams.status',
        ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model));
    }

    /**
     * @return array
     * @since 2.1
     */
    public function columns()
    {
        return [
            'id' => [
                'name'  => 'streams.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name' => [
                'name'  => 'streams.name',
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'streams.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'name'  => 'streams.status',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * @return array
     * @since 2.1
     * @throws \Throwable
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('stream.create'), 'stream.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Stream::class);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('stream.deletes'), 'stream.destroy', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'streams.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'streams.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'streams.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }
}
