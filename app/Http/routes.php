<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group([], function()
{
    Route::get("/tasks", "TasksController@index");
    Route::get("/tasks/create", "TasksController@create");
    Route::post("/tasks/store", "TasksController@store");
    Route::get("/tasks/{id}/edit", "TasksController@edit");
    Route::post("/tasks/update", "TasksController@update");
    Route::get("/tasks/{id}/active", "TasksController@active");
    Route::get("/tasks/{id}/deactive", "TasksController@deactive");
    Route::post("/tasks/delete", "TasksController@destroy");
});