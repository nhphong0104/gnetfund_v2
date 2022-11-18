<?php

namespace Botble\Signal\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Signal\Forms\AssetForm;
use Botble\Signal\Http\Requests\AssetRequest;
use Botble\Signal\Http\Requests\SignalRequest;
use Botble\Signal\Repositories\Interfaces\AssetInterface;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Signal\Tables\AssetTable;
use Illuminate\Http\Request;
use Exception;
use Botble\Signal\Tables\SignalTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Signal\Forms\SignalForm;
use Botble\Base\Forms\FormBuilder;
use Illuminate\Support\Facades\Auth;

class  AssetController extends BaseController
{
    /**
     * @var AssetInterface
     */
    protected $assetRepository;

    /**
     * SignalController constructor.
     * @param AssetInterface $signalRepository
     */
    public function __construct(AssetInterface $assetRepository)
    {
        $this->assetRepository = $assetRepository;
    }

    /**
     * Display all signals
     * @param SignalTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(AssetTable $table)
    {

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/signal::assets.create'));

        return $formBuilder->create(AssetForm::class)->renderForm();
    }

    /**
     * Insert new Signal into database
     *
     * @param SignalRequest $request
     * @return BaseHttpResponse
     */
    public function store(AssetRequest $request, BaseHttpResponse $response)
    {
        $signal = $this->assetRepository->createOrUpdate($request->input(),[
            'author_id'   => Auth::user()->getKey(),
        ]);

        event(new CreatedContentEvent(SIGNAL_MODULE_SCREEN_NAME, $request, $signal));

        return $response
            ->setPreviousUrl(route('assets.index'))
            ->setNextUrl(route('assets.edit', $signal->id))
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
        $signal = $this->assetRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $signal));

        page_title()->setTitle(trans('plugins/signal::assets.edit') . ' "' . $signal->name . '"');

        return $formBuilder->create(SignalForm::class, ['model' => $signal])->renderForm();
    }

    /**
     * @param $id
     * @param SignalRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, AssetRequest $request, BaseHttpResponse $response)
    {
        $signal = $this->assetRepository->findOrFail($id);

        $signal->fill($request->input());

        $this->assetRepository->createOrUpdate($signal);

        event(new UpdatedContentEvent(SIGNAL_MODULE_SCREEN_NAME, $request, $signal));

        return $response
            ->setPreviousUrl(route('assets.index'))
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
            $signal = $this->assetRepository->findOrFail($id);

            $this->assetRepository->delete($signal);

            event(new DeletedContentEvent(SIGNAL_MODULE_SCREEN_NAME, $request, $signal));

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
            $signal = $this->assetRepository->findOrFail($id);
            $this->assetRepository->delete($signal);
            event(new DeletedContentEvent(SIGNAL_MODULE_SCREEN_NAME, $request, $signal));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
