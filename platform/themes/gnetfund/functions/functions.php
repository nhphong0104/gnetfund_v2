<?php

register_page_template([
    'default' => 'Default',
]);

register_sidebar([
    'id'          => 'second_sidebar',
    'name'        => 'Second sidebar',
    'description' => 'This is a sample sidebar for gnetfund theme',
]);
theme_option()
    ->setSection([ // Set section with no field
        'title' => __('Display home'),
        'desc' => __('Display home'),
        'id' => 'opt-text-subsection-home',
        'subsection' => true,
        'icon' => 'fa fa-display',
    ])
    ->setField([ // Set field for section
        'id' => 'profit',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Profit'),
        'attributes' => [
            'name' => 'profit',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Profit'),
                'data-counter' => 120,
            ]
        ],
        'helper' => __('Balance on Fund'),
    ])
    ->setField([ // Set field for section
        'id' => 'balance',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Balance'),
        'attributes' => [
            'name' => 'balance',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Balance'),
                'data-counter' => 120,
            ]
        ],
        'helper' => __('Balance on Fund'),
    ])
    ->setField([ // Set field for section
        'id' => 'equity',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Equity'),
        'attributes' => [
            'name' => 'equity',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Equity'),
                'data-counter' => 120,
            ]
        ],
        'helper' => __('Equity on Fund'),
    ])
    ->setField([ // Set field for section
        'id' => 'deposits',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Deposits'),
        'attributes' => [
            'name' => 'deposits',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Deposits'),
                'data-counter' => 120,
            ]
        ],
    ])
    ->setField([ // Set field for section
        'id' => 'withdrawals',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Withdrawals'),
        'attributes' => [
            'name' => 'withdrawals',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Withdrawals'),
                'data-counter' => 120,
            ]
        ],
    ])
    ->setField([ // Set field for section
        'id' => 'trades',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Trades'),
        'attributes' => [
            'name' => 'trades',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Trades'),
                'data-counter' => 120,
            ]
        ],
    ])
    ->setField([ // Set field for section
        'id' => 'pips',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Pips'),
        'attributes' => [
            'name' => 'pips',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Pips'),
                'data-counter' => 120,
            ]
        ],
    ])
    ->setField([ // Set field for section
        'id' => 'won',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Won'),
        'attributes' => [
            'name' => 'won',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Won'),
                'data-counter' => 120,
            ]
        ],
    ])
    ->setField([ // Set field for section
        'id' => 'lots',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Lots'),
        'attributes' => [
            'name' => 'lots',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Lots'),
                'data-counter' => 120,
            ]
        ],
    ])
    ->setField([ // Set field for section
        'id' => 'max-drawdown',
        'section_id' => 'opt-text-subsection-home',
        'type' => 'number',
        'label' => __('Max Drawdown'),
        'attributes' => [
            'name' => 'max-drawdown',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Max Drawdown'),
                'data-counter' => 120,
            ]
        ],
    ])
;
RvMedia::setUploadPathAndURLToPublic();
