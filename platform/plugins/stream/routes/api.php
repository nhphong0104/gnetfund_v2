<?php

Route::group([
    'middleware' => 'api',
    'prefix'     => 'api/v1',
    'namespace'  => 'Botble\Stream\Http\Controllers\API',
], function () {

    Route::post('loadmore/stream', 'MarketsNewsController@loadStream');

});
