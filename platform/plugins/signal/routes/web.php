<?php

Route::group(['namespace' => 'Botble\Signal\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'signals', 'as' => 'signal.'], function () {
            Route::resource('', 'SignalController')->parameters(['' => 'signal']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'SignalController@deletes',
                'permission' => 'signal.destroy',
            ]);
        });

        Route::group(['prefix' => 'strategies', 'as' => 'strategies.'], function () {
            Route::resource('', 'StrategyController')->parameters(['' => 'strategy']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'StrategyController@deletes',
                'permission' => 'strategy.destroy',
            ]);
        });

        Route::group(['prefix' => 'assets', 'as' => 'assets.'], function () {
            Route::resource('', 'AssetController')->parameters(['' => 'asset']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'AssetController@deletes',
                'permission' => 'asset.destroy',
            ]);
        });
    });

});
