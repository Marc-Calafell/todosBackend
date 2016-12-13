<?php

Gate::define('possible-gate', function () {
    return false;
});

Gate::define('impossible-gate', function () {
    return false;
});


//Gate::define('update-task', function ($user, $task) {
//    return $user->id == $task->user_id;
//});
Gate::define('update-task', function ($user) {
    return $user->isAdmin();
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