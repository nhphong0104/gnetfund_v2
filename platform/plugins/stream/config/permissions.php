<?php

return [
    [
        'name' => 'Markets News',
        'flag' => 'plugin.markets-news',
    ],
    [
        'name' => 'Markets News',
        'flag' => 'markets-news.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'markets-news.create',
        'parent_flag' => 'markets-news.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'markets-news.edit',
        'parent_flag' => 'markets-news.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'markets-news.destroy',
        'parent_flag' => 'markets-news.index',
    ],

];
