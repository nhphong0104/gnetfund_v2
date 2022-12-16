<?php

namespace Botble\Emailfund\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Emailfund\Http\Requests\EmailfundRequest;
use Botble\Emailfund\Repositories\Interfaces\EmailfundInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Emailfund\Tables\EmailfundTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Emailfund\Forms\EmailfundForm;
use Botble\Base\Forms\FormBuilder;

class EmailfundController extends BaseController
{
    /**
     * @var EmailfundInterface
     */
    protected $emailfundRepository;

    /**
     * @param EmailfundInterface $emailfundRepository
     */
    public function __construct(EmailfundInterface $emailfundRepository)
    {
        $this->emailfundRepository = $emailfundRepository;
    }

    /**
     * @param EmailfundTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(EmailfundTable $table)
    {
        page_title()->setTitle(trans('plugins/emailfund::emailfund.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/emailfund::emailfund.create'));

        return $formBuilder->create(EmailfundForm::class)->renderForm();
    }

    /**
     * @param EmailfundRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(EmailfundRequest $request, BaseHttpResponse $response)
    {
        $emailfund = $this->emailfundRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(EMAILFUND_MODULE_SCREEN_NAME, $request, $emailfund));

        return $response
            ->setPreviousUrl(route('emailfund.index'))
            ->setNextUrl(route('emailfund.edit', $emailfund->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $emailfund = $this->emailfundRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $emailfund));

        page_title()->setTitle(trans('plugins/emailfund::emailfund.edit') . ' "' . $emailfund->name . '"');

        return $formBuilder->create(EmailfundForm::class, ['model' => $emailfund])->renderForm();
    }

    /**
     * @param int $id
     * @param EmailfundRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, EmailfundRequest $request, BaseHttpResponse $response)
    {
        $emailfund = $this->emailfundRepository->findOrFail($id);

        $emailfund->fill($request->input());

        $emailfund = $this->emailfundRepository->createOrUpdate($emailfund);

        event(new UpdatedContentEvent(EMAILFUND_MODULE_SCREEN_NAME, $request, $emailfund));

        return $response
            ->setPreviousUrl(route('emailfund.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $emailfund = $this->emailfundRepository->findOrFail($id);

            $this->emailfundRepository->delete($emailfund);

            event(new DeletedContentEvent(EMAILFUND_MODULE_SCREEN_NAME, $request, $emailfund));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
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
            $emailfund = $this->emailfundRepository->findOrFail($id);
            $this->emailfundRepository->delete($emailfund);
            event(new DeletedContentEvent(EMAILFUND_MODULE_SCREEN_NAME, $request, $emailfund));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
