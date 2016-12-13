<?php

Gate::define('possible-gate', function () {
    return false;
});

Gate::define('impossible-gate', function () {
    return false;
});


Gate::define('update-task', function ($user, $task) {
    return $user->id == $task->user_id;
});

Gate::define('update-task2', function ($user) {
    return $user->isAdmin();
});

Gate::define('update-task3', function ($user, $task) {
    if($user->isAdmin()) return true;
    return $user->id == $task->user_id;
});

Gate::define('update-task4', function ($user, $task) {
    if($user->isAdmin()) return true;
    if($user->hasRole('editor')) return true;
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