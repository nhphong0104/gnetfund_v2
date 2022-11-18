<?php

namespace Botble\Signal\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Signal\Http\Requests\SignalRequest;
use Botble\Signal\Repositories\Interfaces\SignalInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Signal\Tables\SignalTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Signal\Forms\SignalForm;
use Botble\Base\Forms\FormBuilder;

class SignalController extends BaseController
{
    /**
     * @var SignalInterface
     */
    protected $signalRepository;

    /**
     * SignalController constructor.
     * @param SignalInterface $signalRepository
     */
    public function __construct(SignalInterface $signalRepository)
    {
        $this->signalRepository = $signalRepository;
    }

    /**
     * Display all signals
     * @param SignalTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(SignalTable $table)
    {

        page_title()->setTitle(trans('plugins/signal::signal.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/signal::signal.create'));

        return $formBuilder->create(SignalForm::class)->renderForm();
    }

    /**
     * Insert new Signal into database
     *
     * @param SignalRequest $request
     * @return BaseHttpResponse
     */
    public function store(SignalRequest $request, BaseHttpResponse $response)
    {
        $signal = $this->signalRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(SIGNAL_MODULE_SCREEN_NAME, $request, $signal));

        return $response
            ->setPreviousUrl(route('signal.index'))
            ->setNextUrl(route('signal.edit', $signal->id))
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
        $signal = $this->signalRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $signal));

        page_title()->setTitle(trans('plugins/signal::signal.edit') . ' "' . $signal->name . '"');

        return $formBuilder->create(SignalForm::class, ['model' => $signal])->renderForm();
    }

    /**
     * @param $id
     * @param SignalRequest $request
     * @return BaseHttpResponse
     */
    public function update($id, SignalRequest $request, BaseHttpResponse $response)
    {
        $signal = $this->signalRepository->findOrFail($id);

        $signal->fill($request->input());

        $this->signalRepository->createOrUpdate($signal);

        event(new UpdatedContentEvent(SIGNAL_MODULE_SCREEN_NAME, $request, $signal));

        return $response
            ->setPreviousUrl(route('signal.index'))
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
            $signal = $this->signalRepository->findOrFail($id);

            $this->signalRepository->delete($signal);

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
            $signal = $this->signalRepository->findOrFail($id);
            $this->signalRepository->delete($signal);
            event(new DeletedContentEvent(SIGNAL_MODULE_SCREEN_NAME, $request, $signal));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
