<?php

Route::group(['namespace' => 'Botble\Emailfund\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'emailfunds', 'as' => 'emailfund.'], function () {
            Route::resource('', 'EmailfundController')->parameters(['' => 'emailfund']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'EmailfundController@deletes',
                'permission' => 'emailfund.destroy',
            ]);
        });
    });

});
