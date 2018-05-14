<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'doctors','namespace'=>'Doctors'],function(){

    /*   Config::set('auth.defaults','doctors'); */
      Route::get('login','DoctorAuth@login');
      Route::get('forgot/password','DoctorAuth@forgot_password');
      Route::post('forgot/password','DoctorAuth@forgot_password_post');
      Route::get('reset/password/{token}','DoctorAuth@reset_password');
      Route::post('reset/password/{token}','DoctorAuth@reset_password_final');
      Route::post('login','DoctorAuth@dologin');
      Route::group(['middleware'=>'doctors:doctors'],function(){
          Route::resource('alldoctors','DoctorsController');
          Route::delete('alldoctors/destory/all','DoctorsController@multi_delete');
  
          Route::resource('allchildren','ChildrenController');
          Route::delete('allchildren/destory/all','ChildrenController@multi_delete');
          
          Route::resource('VitalSigns','VitalSignsController');
          Route::delete('VitalSigns/destory/all','VitalSigns@multi_delete');
          Route::get('/',function(){
              return view('doctors.home');
          });
          Route::any('logout','DoctorAuth@logout');
  
      });
      Route::get('lang/{lang}',function($lang){
  
          session()->has('lang') ? session()->forget('lang') :'';
              
          $lang == 'ar' ?session()->put('lang','ar') :session()->put('lang','en');
          return back();
      });
  });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
