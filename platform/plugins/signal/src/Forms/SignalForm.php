<?php

namespace Botble\Signal\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Signal\Enums\SideEnums;
use Botble\Signal\Enums\StatusEnum;
use Botble\Signal\Enums\StatusSignal;
use Botble\Signal\Http\Requests\SignalRequest;
use Botble\Signal\Models\Signal;

class SignalForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {


        $list = get_all_asset();
        $assets = [];
        foreach ($list as $row) {
            $assets[$row->id] = $row->name;
        }
        $assets = [0 => trans('plugins/signal::assets.name')] + $assets;

        $this
            ->setupModel(new Signal)
            ->setValidatorClass(SignalRequest::class)
            ->withCustomFields()
            ->setFormOption('id', 'signal-form')
            ->setWrapperClass('form-body row')

            ->add('asset_id', 'select', [
                'label'      => trans('plugins/signal::assets.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'select-search-full',
                ],
                'choices'    => $assets,
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])

            ->add('side', 'select', [
                'label'      => "Loại lệnh",
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'select-search-full',
                ],
                'choices'    => SideEnums::labels(),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])

            ->add('price_open', 'text', [
                'label'      => "OPEN",
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => "",
                    'data-counter' => 120,
                    'value'        => 0
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])

            ->add('price_close', 'text', [
                'label'      => "CLOSE",
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => "",
                    'data-counter' => 120,
                    'value'        => 0
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])

            ->add('sl', 'text', [
                'label'      => "SL",
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => "",
                    'data-counter' => 120,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])

            ->add('tp', 'text', [
                'label'      => "TP",
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => "",
                    'data-counter' => 120,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])

            ->add('time_start', 'datetime-local', [
                'label'      => "Ngày tạo",
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => "",
                    'data-counter' => 120,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])

            ->add('time_end', 'datetime-local', [
                'label'      => "Ngày đóng",
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => "",
                    'data-counter' => 120,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])

            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => StatusEnum::labels(),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->add('status_signal', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => StatusSignal::labels(),
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
                ],
            ])
            ->setBreakFieldPoint('status');
    }
}
