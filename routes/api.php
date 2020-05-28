<?php

use App\Http\Controllers\ProductController;
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

//Route::get('/lala','PostController@getAllPosts');
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::resource('product','ProductController');
//Route::get('get_all', 'PostController@getAllPosts')->name('fetch_all');
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('get_all', 'PostController@getAllPosts')->name('fetch_all');
    Route::post('create_post', 'PostController@createPost')->name('create_post');
    //Route::resource('product','ProductController');
});




//Route::get('logout', 'UserController@logout');
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
