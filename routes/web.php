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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', "LoginController@index");
Route::post('/login', "LoginController@login");
Route::get('/logout', "LoginController@logout");

Route::get("/register", "RegisterController@index");
Route::post("/register", "RegisterController@register");
Route::get("/register/validate/{registerHash}", "RegisterController@verify");

Route::get("/regions/fetch-all", "RegionController@fetchAll");
Route::get("/communes/fetch/{region_id}", "CommuneController@fetchByRegion");
Route::get("/job-categories/fetch-all", "JobCategoryController@fetchAll");

Route::get('/home', "HomeController@index")->middleware('auth');
Route::get('/profile/user', "ProfileController@index")->middleware('auth');
Route::get('/profile/business', "ProfileController@businessIndex")->middleware('auth');
Route::post('/profile/business/update', "ProfileController@businessUserBusinessUpdate")->middleware('auth');
Route::post('/profile/business/business/update', "ProfileController@businessBusinessUpdate")->middleware('auth');
Route::post('/profile/update', "ProfileController@update")->middleware('auth');
Route::get('/profiles/academic/fetch', "ProfileController@fetchAcademicBackground")->middleware('auth');
Route::post('/profile/academic/store', "ProfileController@storeAcademicBackground")->middleware('auth');
Route::post('/profile/academic/delete', "ProfileController@deleteAcademicBackground")->middleware('auth');
Route::post('/profiles/job-resume/store', "ProfileController@storeJobResume")->middleware('auth');
Route::get('/profiles/job-background/fetch', "ProfileController@fetchJobBackground")->middleware('auth');
Route::post('/profiles/job-background/store', "ProfileController@storeJobBackground")->middleware('auth');
Route::post('/profiles/others/store', "ProfileController@storeOthers")->middleware('auth');

Route::get('/admin/dashboard', "AdminController@index");
Route::get('/admin/user/index', "UserController@index");
Route::get('/admin/user/fetch/{page}', "UserController@fetch");
Route::post('/admin/user/delete', "UserController@delete");
