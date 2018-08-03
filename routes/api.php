<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/register', 'UserController@store');
Route::middleware(['auth:api'])->group(function () {
    Route::post('/me', 'UserController@me');
    Route::get('/get-list-users', 'UserController@index');
    Route::post('/roles', 'RolesController@store');
    // Route::post('/create-rule-date', 'RuleDateController@store');
    Route::post('/create-group-users', 'GroupUserController@store');
    Route::get('/get-all-group-users', 'GroupUserController@getAllGroupUsers');
    Route::put('/update-group-users/{id}', 'GroupUserController@update');
    Route::delete('/delete-group-users/{id}', 'GroupUserController@destroy');
});
