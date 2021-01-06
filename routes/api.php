<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//create todo
Route::post('todos', 'App\Http\Controllers\TodoController@store');

//get all todos
Route::get('todos', 'App\Http\Controllers\TodoController@index');

//get single todo
Route::get('todos/{todo}', 'App\Http\Controllers\TodoController@show');

//update todo
Route::put('todos/{todo}', 'App\Http\Controllers\TodoController@update');

//mark todo done
Route::put('todo-done/{todo}', 'App\Http\Controllers\TodoController@markTodoDone');

//delete todo
Route::delete('todos/{todo}', 'App\Http\Controllers\TodoController@destroy');

//multi delete todo
Route::post('multi-drop', 'App\Http\Controllers\TodoController@multiDestroy');
