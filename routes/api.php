<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//routes from previous

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'backend', 'prefix' => 'admin'], function () {

    Route::post('login', 'AuthController@login');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

});

Route::group(['namespace' => 'frontend'], function () {

    Route::post('login', 'AuthController@login');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

});

Route::apiResources(['user'=>'API\UserController']);
Route::apiResources(['property'=>'API\PropertyController']);
Route::apiResources(['frontenquiry'=>'API\FrontEnquiryController@show']);
Route::get('profile/{id}','API\UserController@profile');
Route::put('profile','API\UserController@updateProfile');
Route::get('findUser','API\UserController@search');
Route::get('findProperty','API\PropertyController@search');
Route::get('propertyHouse/{id}','API\PropertyController@getHouse');
Route::get('getPropertyByUserId/{id}','API\PropertyController@getPropertyByUserId');
Route::put('changeStatus/{id}/{value}','API\PropertyController@changeStatus');
Route::apiResources(['enquiry'=>'API\EnquiryController']);

Route::get('allfrontenquiries/{id}','API\EnquiryController@allfrontenquiries');
Route::get('frontDetailEnquiry/{id}','API\EnquiryController@frontDetailEnquiry');

Route::apiResources(['userfavorite'=>'API\FavoriteController']);
Route::get('getFavorites/{id}/{p_id}','API\FavoriteController@getFavorites');
Route::delete('deleteFavorites/{id}/{p_id}','API\FavoriteController@deleteFavorites');
Route::apiResources(['location'=>'API\LocationController']);

Route::get('similarProperty/{category}/{id}','API\PropertyController@similarProperty');

Route::get('getFilter/{val}','API\PropertyController@getFilter');

Route::get('singleproperty/{id}', 'API\PropertyController@singleProperty');
Route::get('latestproperty', 'API\PropertyController@getLatestProperty');
Route::put('getviews/{id}', 'API\PropertyController@getViews');
Route::get('trending', 'API\PropertyController@getTrending');

//account activate
Route::any('/register/activate/{token}', 'frontend\AuthController@accountActivation');

//password reset
Route::post('/password_reset/email_verify', 'frontend\AuthController@create');
Route::post('/password_reset', 'frontend\AuthController@reset');

//socialite
Route::post('socialLogin/{provider}', 'frontend\AuthController@SocialSignUp');

//subscription
Route::post('newsletter','frontend\AuthController@subscribe');
