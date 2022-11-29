<?php

namespace Botble\Stream\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Stream\Http\Requests\StreamRequest;
use Botble\Stream\Repositories\Interfaces\WallStreet;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Stream\Tables\StreamTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Stream\Forms\StreamForm;
use Botble\Base\Forms\FormBuilder;

class MarketsNewsController extends BaseController
{
    /**
     * @var StreamInterface
     */
    protected $streamRepository;

    /**
     * MarketsNewsController constructor.
     * @param StreamInterface $streamRepository
     */
    public function __construct(StreamInterface $streamRepository)
    {
        $this->streamRepository = $streamRepository;
    }

    /**
     * Display all streams
     * @param StreamTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(StreamTable $table)
    {

        page_title()->setTitle(trans('plugins/stream::stream.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/stream::stream.create'));

        return $formBuilder->create(StreamForm::class)->renderForm();
    }

    /**
     * Insert new Stream into database
     *
     * @param StreamRequest $request
     * @return BaseHttpResponse
     */
    public function store(StreamRequest $request, BaseHttpResponse $response)
    {
        $stream = $this->streamRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(STREAM_MODULE_SCREEN_NAME, $request, $stream));

        return $response
            ->setPreviousUrl(route('stream.index'))
            ->setNextUrl(route('stream.edit', $stream->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * Show edit form
     *
     * @param $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $stream = $this->streamRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $stream));

        page_title()->setTitle(trans('plugins/stream::stream.edit') . ' "' . $stream->name . '"');

        return $formBuilder->create(StreamForm::class, ['model' => $stream])->renderForm();
    }

    /**
     * @param $id
     * @param StreamRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, StreamRequest $request, BaseHttpResponse $response)
    {
        $stream = $this->streamRepository->findOrFail($id);

        $stream->fill($request->input());

        $this->streamRepository->createOrUpdate($stream);

        event(new UpdatedContentEvent(STREAM_MODULE_SCREEN_NAME, $request, $stream));

        return $response
            ->setPreviousUrl(route('stream.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $stream = $this->streamRepository->findOrFail($id);

            $this->streamRepository->delete($stream);

            event(new DeletedContentEvent(STREAM_MODULE_SCREEN_NAME, $request, $stream));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.cannot_delete'));
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $stream = $this->streamRepository->findOrFail($id);
            $this->streamRepository->delete($stream);
            event(new DeletedContentEvent(STREAM_MODULE_SCREEN_NAME, $request, $stream));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }

    public function load_data(Request $request)
    {
        if($request->ajax())
        {
            dd($request);
        }
            if($request->page > 0)
            {
                $data = DB::table('post')
                    ->where('id', '<', $request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();
            }
            else
            {
                $data = DB::table('post')
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();
            }
            $output = '';
            $last_id = '';

            if(!$data->isEmpty())
            {
                foreach($data as $row)
                {
                    $output .= '';
            }
            echo $output;
        }
    }
}
