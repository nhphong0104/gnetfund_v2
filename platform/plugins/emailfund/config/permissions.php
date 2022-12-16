<?php

return [
    [
        'name' => 'Emailfunds',
        'flag' => 'emailfund.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'emailfund.create',
        'parent_flag' => 'emailfund.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'emailfund.edit',
        'parent_flag' => 'emailfund.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'emailfund.destroy',
        'parent_flag' => 'emailfund.index',
    ],
];
