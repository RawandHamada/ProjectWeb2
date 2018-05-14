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
Route::group(['namespace'=>'Api'],function(){

    Route::group(['middleware'=>'auth:api'],function(){

    
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::get('all/doctors','DoctorsController@all_doctors');
        Route::get('doctor/{doctor_id}','DoctorsController@doctor');
        Route::get('all/children','ChildrenController@all_children');
        Route::get('child/{child_id}','ChildrenController@child');
    });
        Route::post('login','Users@login'); 
    
});
