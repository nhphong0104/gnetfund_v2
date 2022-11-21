<?php

namespace Botble\Signal\Tables;

use Auth;
use Botble\Signal\Enums\StatusEnum;
use Botble\Signal\Repositories\Interfaces\SignalInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Signal\Models\Signal;

class SignalTable extends TableAbstract
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
     * SignalTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param SignalInterface $signalRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, SignalInterface $signalRepository)
    {
        $this->repository = $signalRepository;
        $this->setOption('id', 'table-plugins-signal');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['signal.edit', 'signal.destroy'])) {
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
            ->editColumn('id', function ($item) {
                if (!Auth::user()->hasPermission('signal.edit')) {
                    return $item->id;
                }
                return anchor_link(route('signal.edit', $item->id), $item->id);
            })
            ->editColumn('side', function ($item) {
                return $item->side->toHtml();
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status_signal', function ($item) {
                return $item->status_signal->toHtml();
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return table_actions('signal.edit', 'signal.destroy', $item);
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
            'signals.id',
            'signals.side',
            'signals.asset_id',
            'signals.price_open',
            'signals.price_close',
            'signals.sl',
            'signals.tp',
            'signals.pip',
            'signals.status_signal',
            'signals.time_start',
            'signals.time_end',
            'signals.created_at',
            'signals.status',
        ])->with('asset');

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
                'name'  => 'signals.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'asset_id' => [
                'name'  => 'signals.asset_id',
                'title' => trans('plugins/signal::signal.form.asset_id'),
                'width' => '100px',
            ],
            'side' => [
                'name'  => 'signals.side',
                'title' => trans('plugins/signal::signal.form.side'),
                'width' => '100px',
            ],
            'price_open' => [
                'name'  => 'signals.price_open',
                'title' => trans('plugins/signal::signal.form.price_open'),
                'width' => '100px',
            ],
            'sl' => [
                'name'  => 'signals.sl',
                'title' => trans('plugins/signal::signal.form.sl'),
                'width' => '100px',
            ],
            'tp' => [
                'name'  => 'signals.tp',
                'title' => trans('plugins/signal::signal.form.tp'),
                'width' => '100px',
            ],
            'price_close' => [
                'name'  => 'signals.price_close',
                'title' => trans('plugins/signal::signal.form.price_close'),
                'width' => '100px',
            ],
//            'pip' => [
//                'name'  => 'signals.pip',
//                'title' => trans('plugins/signal::signal.form.pip'),
//                'width' => '100px',
//            ],
            'time_start' => [
                'name'  => 'signals.time_start',
                'title' => trans('plugins/signal::signal.form.time_start'),
                'width' => '100px',
            ],
            'time_end' => [
                'name'  => 'signals.time_end',
                'title' => trans('plugins/signal::signal.form.time_end'),
                'width' => '100px',
            ],
            'status' => [
                'name'  => 'signals.status',
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
        $buttons = $this->addCreateButton(route('signal.create'), 'signal.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Signal::class);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('signal.deletes'), 'signal.destroy', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [

            'signals.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => StatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', StatusEnum::values()),
            ],
            'signals.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }
}
