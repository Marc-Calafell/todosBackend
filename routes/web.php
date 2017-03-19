<?php

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'can:show,App\Task'], function () {
        Route::get('/tasks', function () {
            return view('tasks');
        });
    });

    Route::get('/profile/tokens', function () {
        return view('tokens');
    });




    #adminlte_routes
    Route::get('Bootstrap', 'BootstrapController@index')->name('Bootstrap');
    Route::get('FlexBox', 'FlexBoxController@index')->name('FlexBox');
    Route::get('CSSTables', 'CSSTablesController@index')->name('CSSTables');
    Route::get('layoutfload', 'LayoutfloadController@index')->name('layoutfload');
    Route::get('boxmodel', 'BoxmodelController@index')->name('boxmodel');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/float', function () {
    return view('float');
});


Route::get('auth/github', 'Auth\MySocialAuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\MySocialAuthController@handleProviderCallback');

Route::get('auth/facebook', 'Auth\MySocialAuthController@facebookRedirect');
Route::get('auth/facebook/callback', 'Auth\MySocialAuthController@facebookCallback');





