<?php


Gate::define('update-task', function ($user, $task) {
    return $user->id == $task->user_id;
});






Route::group(['middleware' => 'auth'], function() {
    Route::get('/tasks', function () {
        return view('tasks');
    });

    Route::get('/profile/tokens', function () {
        return view('tokens');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpinfo', function () {
    phpinfo();
});