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
    Route::get('boxmodel', 'BoxmodelController@index')->name('boxmodel');

});

Route::get('/', function () {
    return view('welcome');
});




