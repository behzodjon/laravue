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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('categories', 'CategoryController@index');
    Route::get('courses', 'CourseController@index');
    Route::post('course', 'CourseController@store');
    Route::put('courses/{course}', 'CourseController@update');
    Route::delete('courses/{course}', 'CourseController@destroy');
});
