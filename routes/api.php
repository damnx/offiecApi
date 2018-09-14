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
Route::post('/register', 'Api\UserController@store');
Route::get('/test', 'Api\RolesController@test');

Route::middleware(['auth:api'])->group(function () {

    Route::post('/me', 'Api\UserController@me');
    Route::get('/get-list-users', 'UserController@index');
    Route::post('/roles', 'RolesController@store');
    
    Route::post('/create-job-calendar', 'Api\JobCalendarController@store');
    Route::put('/update-job-calendar/{id}', 'Api\JobCalendarController@update');
    Route::delete('/delete-job-calendar/{id}', 'Api\JobCalendarController@destroy');

    Route::post('/create-group-users', 'Api\GroupUsersController@store');
    Route::put('/update-group-users/{id}', 'Api\GroupUsersController@update');
    Route::get('/details-group-users/{id}', 'Api\GroupUsersController@show');
    Route::get('/get-list-group-users', 'Api\GroupUsersController@getListGroupUsers');
    Route::delete('/delete-group-users/{id}', 'Api\GroupUsersController@destroy');

    Route::post('/create-role', 'Api\RolesController@store');

    Route::post('/create-task', 'Api\TasksController@store');

    // Route::delete('/restore-group-users/{id}', 'Api\GroupUsersController@restoreGroupUsers');
   

    // Route::post('/create-date-saturday-working-full', 'SaturdayFullController@store');
    // Route::get('/get-date-saturday-working-full/{type}', 'SaturdayFullController@getSaturdayFullController');
    // Route::post('/create-group-users', 'GroupUserController@store');
    // Route::get('/get-all-group-users-paginate', 'GroupUserController@getAllGroupUsersPaginate');
    // Route::get('/get-all-group-users', 'GroupUserController@getAllGroupUsers');
    // Route::put('/update-group-users/{id}', 'GroupUserController@update');
    // Route::delete('/delete-group-users/{id}', 'GroupUserController@destroy');
    // Route::post('/create-calendar-work', 'CalendarControllerWork@store');
    // Route::get('/get-calendar-work/{date}', 'CalendarControllerWork@getCalendarWork');
});
