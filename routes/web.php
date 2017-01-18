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




