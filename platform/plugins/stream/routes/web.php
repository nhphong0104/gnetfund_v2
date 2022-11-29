<?php



Route::group(['namespace' => 'Botble\Stream\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'markets-news', 'as' => 'markets-news.'], function () {
            Route::resource('', 'MarketsNewsController')->parameters(['' => 'markets-news']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'MarketsNewsController@deletes',
                'permission' => 'markets-news.destroy',
            ]);
        });

    });

});
