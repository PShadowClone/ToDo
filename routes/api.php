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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/**
 * register new user
 *
 * @type: Route
 */
Route::post('register',['uses' => 'Api\UserController@store' , 'as' => 'register']);
/**
 * all sub requests should be authenticated
 *
 * @type: RouteGroup
 */
Route::group(['middleware' => ['auth:api']],function(){
    /**
     * this line publish all user's routes such as
     * store, update, and delete.
     *
     * @type: RouteResource
     */
    Route::resource('users', 'Api\UserController');

});
