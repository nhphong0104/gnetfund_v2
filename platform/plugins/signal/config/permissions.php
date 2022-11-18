<?php

return [
    [
        'name' => 'Signals',
        'flag' => 'plugins.signal',
    ],
    [
        'name'        => 'Signals',
        'flag'        => 'signal.index',
        'parent_flag' => 'plugins.signal',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'signal.create',
        'parent_flag' => 'signal.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'signal.edit',
        'parent_flag' => 'signal.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'signal.destroy',
        'parent_flag' => 'signal.index',
    ],

    [
        'name'        => 'Strategies',
        'flag'        => 'strategies.index',
        'parent_flag' => 'plugins.signal',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'strategies.create',
        'parent_flag' => 'strategies.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'strategies.edit',
        'parent_flag' => 'strategies.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'strategies.destroy',
        'parent_flag' => 'strategies.index',
    ],

    [
        'name'        => 'Assets',
        'flag'        => 'assets.index',
        'parent_flag' => 'plugins.signal',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'assets.create',
        'parent_flag' => 'assets.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'assets.edit',
        'parent_flag' => 'assets.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'assets.destroy',
        'parent_flag' => 'assets.index',
    ],
];
