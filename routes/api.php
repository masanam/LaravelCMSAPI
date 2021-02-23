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


    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'API\AuthAPIController@logout');

    });

/** post data */
Route::post('/saveContact','API\PublicAPIController@saveContact');

Route::post('/saveCareerRecruitment','API\PublicAPIController@saveCareerRecruitment');

Route::post('/saveCareerRecruitment2','API\PublicAPIController@saveCareerRecruitment2');

Route::post('/saveInvestor','API\PublicAPIController@saveInvestor');

Route::post('/login', 'API\AuthAPIController@login');

Route::post('/signup', 'API\AuthAPIController@signup');



Route::resource('users', 'Admin\UsersAPIController');