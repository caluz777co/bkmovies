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

Route::apiResource("peliculas", "PeliculasController");
Route::apiResource("categorias", "CategoriasController");
Route::get("peliculas/{id}", "PeliculasController@show");
Route::get("top", "PeliculasController@getTop");
Route::post("comentarios", "PeliculasController@showComments");
Route::post("agregar-comentarios", "PeliculasController@addComment");
Route::put("megusta/{id}", "PeliculasController@updateLike");
Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('profile', 'Api\AuthController@profile');
});
