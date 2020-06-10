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
Route::resource('v1/products', 'Api\ProductController', ['only' => 'update']);
Route::resource('v1/shop', 'Api\ProductController', ['only' => 'update']);
Route::resource('v1/categories', 'Api\ProductController', ['only' => 'update']);

Route::post('/v1/yml_generator', 'Api\YmlGeneratorController@generate');
Route::get('v1/get_yml', 'Api\YmlGeneratorController@get_url');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
