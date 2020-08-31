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
Route::post('/profiles/show/academic/fetch', "ProfileController@fetchShowAcademicBackground")->middleware('auth');
Route::post('/profile/academic/store', "ProfileController@storeAcademicBackground")->middleware('auth');
Route::post('/profile/academic/update', "ProfileController@updateAcademicBackground")->middleware('auth');
Route::post('/profile/academic/delete', "ProfileController@deleteAcademicBackground")->middleware('auth');
Route::post('/profiles/job-resume/store', "ProfileController@storeJobResume")->middleware('auth');
Route::get('/profiles/job-background/fetch', "ProfileController@fetchJobBackground")->middleware('auth');
Route::post('/profiles/show/job-background/fetch', "ProfileController@fetchShowJobBackground")->middleware('auth');
Route::post('/profiles/job-background/store', "ProfileController@storeJobBackground")->middleware('auth');
Route::post('/profile/job-background/update', "ProfileController@updateJobBackground")->middleware('auth');
Route::post('/profile/job-background/delete', "ProfileController@deleteJobBackground")->middleware('auth');
Route::post('/profiles/others/store', "ProfileController@storeOthers")->middleware('auth');
Route::get("/profile/show/{email}", "ProfileController@showProfile");

Route::get("/offers/create", "OfferController@create")->middleware('auth');
Route::post("/offers/store", "OfferController@store")->middleware('auth');
Route::get("/offers/fetch/{page}", "OfferController@userFetch")->middleware('auth');
Route::get("/offers/business/fetch/{page}", "OfferController@businessFetch")->middleware('auth');
Route::get("/offers/detail/{slug}", "OfferController@show")->middleware('auth');

Route::post("/proposal/store", "ProposalController@store")->middleware('auth');
Route::post("/proposal/answer", "ProposalController@answer")->middleware('auth');
Route::post("/proposal/fetch", "ProposalController@fetch")->middleware('auth');
Route::get("/my-proposals", "ProposalController@index")->middleware('auth');
Route::get("/my-proposals/fetch/{page}", "ProposalController@myProposals")->middleware('auth');
Route::get("/proposal/messages/{offer}/{email}", "ProposalController@messages")->middleware('auth');
Route::post("/proposal/messages/fetch", "ProposalController@fetchMessages")->middleware('auth');

Route::get("my-applies", "ProposalController@myAppliesView")->middleware('auth');
Route::get("/my-applies/fetch/{page}", "ProposalController@myApplies")->middleware('auth');

Route::get('plans/available', 'PlanController@index');

Route::post("/cart/store", "CartController@store");

Route::post("/contract", "ContractController@store");

Route::get('/checkout/{cart}', 'CheckoutController@initTransaction')->name('checkout');  
Route::post('/checkout/webpay/response', 'CheckoutController@response')->name('checkout.webpay.response');  
Route::post('/checkout/webpay/finish', 'CheckoutController@finish')->name('checkout.webpay.finish');

Route::get("/country/fetch", "CountriesController@fetch");

///////////////////////// ADMIN /////////////////////////////////////

Route::get('/admin/dashboard', "AdminController@index");
Route::get('/admin/user/index', "UserController@index");
Route::get('/admin/user/fetch/{page}', "UserController@fetch");
Route::post('/admin/user/delete', "UserController@delete");

Route::get('/admin/plans', "PlanController@adminIndex")->middleware('auth');
Route::get("/admin/plans/fetch", "PlanController@fetch");
Route::post("/admin/plans/store", "PlanController@store");
Route::post("/admin/plans/delete", "PlanController@delete");
Route::post("/admin/plans/update", "PlanController@update");