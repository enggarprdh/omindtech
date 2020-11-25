<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', 'LoginController@Index')->name('login');
Route::post('/login', 'LoginController@Login');
Route::get('/logout', 'LoginController@Logout');
Route::get('id',function(){
    session(['locale'=>'id']);
    return back();
});
Route::get('en',function(){
    session(['locale'=>'en']);
    return back();
});


Route::group(['middleware' => ['auth']], function () {
    //Start Role Route Section//
    Route::get('/', 'DashboardController@Index')->name('home');
    Route::post('/role/save', 'RoleController@Save')->name('save_role');
    Route::post('/role/update', 'RoleController@Update')->name('update_role');
    Route::get('/role', 'RoleController@Index')->name('role');
    Route::get('/role/getdatafeature', 'RoleController@GetDataFeature')->name('get_data_feature');
    Route::get('/role/getrole', 'RoleController@GetRole')->name('get_role');
    Route::get('/role/create', 'RoleController@Create')->name('create_role');
    Route::delete('/role/status/{id}', 'RoleController@UpdateStatus')->name('change_status');
    Route::get('/role/edit/{id}', 'RoleController@Edit')->name('edit_role');
    Route::get('/role/getfeature/{id}', 'RoleController@GetFeature')->name('get_feature');
    Route::get('/role/getrolefeature/{id}', 'RoleController@GetFeaturePerRole')->name('get_role_feature');
    Route::delete('/role/delete/{id}', 'RoleController@Delete')->name('delete_role');
    Route::get('/role/roledropdown', 'RoleController@GetRoleDropdown')->name('get_role_dropdown');
    //End Role Route Section//

    //Start User Route Section//
    Route::get('/user', 'UserController@Index')->name('user');
    Route::get('/user/getuser', 'UserController@GetUser')->name('get_user');
    Route::get('/user/edit/{id}','UserController@Edit')->name('edit_user');
    Route::delete('/user/status/{id}','UserController@UpdateStatus')->name('change_status_user');
    Route::get('/user/create', 'UserController@Create')->name('create_user');
    Route::post('/user/save', 'UserController@Save')->name('save_user');
    Route::post('/user/uploadavatar', 'UserController@UploadAvatar')->name('upload_avatar');
    //End User Route Section//

    //Start Brand Route Section//
    Route::get('/brand', 'BrandController@Index')->name('brand');
    //End Brand Route Section//
});
