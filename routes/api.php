<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::resource('task', 'TasksController');   // Model i Controlador per a Tasks
    Route::resource('user', 'UsersController');   // Model i Controlador per a Users
    Route::resource('user.task', 'UserTasksController');   // Model i Controlador per a UserTasks
});
