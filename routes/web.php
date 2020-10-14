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

Route::get("/conference/{room_name}", "ConferenceController@conferenceRoom")->middleware('auth');
Route::get("/conference/room/{room_name}", "ConferenceController@conferenceShowRoom")->middleware('auth');
Route::post("/conference/login", "ConferenceController@conferenceLogin")->middleware('auth');

Route::get('/', "LoginController@index")->name("login")->middleware('guest');
Route::post('/login', "LoginController@login");
Route::get('/logout', "LoginController@logout");

Route::get("/forgot-password", "ForgotPasswordController@index");
Route::post("/forgot-password/send", "ForgotPasswordController@send");
Route::get("/password/recovery/restore/{recovery_hash}", "ForgotPasswordController@restore");
Route::post("/password/restore", "ForgotPasswordController@update");

Route::get("/register", "RegisterController@index")->middleware("guest");
Route::post("/register", "RegisterController@register");
Route::get("/register/validate/{registerHash}", "RegisterController@verify")->middleware("guest");

Route::get("/regions/fetch-all", "RegionController@fetchAll");
Route::get("/communes/fetch/{region_id}", "CommuneController@fetchByRegion");
Route::get("/job-categories/fetch-all", "JobCategoryController@fetchAll");

Route::get('/home', "HomeController@index")->middleware('auth');
Route::get('/my-offers', function(){
    return view("users.businessIndex");
})->middleware("business")->middleware('auth');
Route::get("/user/offer", function(){
    return view("users.index");
});

Route::get("/profile/show/{email}", "ProfileController@showProfile")->middleware("auth");
Route::get("/profile/download/{email}", "ProfileController@download")->middleware("auth");

Route::post('/profiles/show/academic/fetch', "ProfileController@fetchShowAcademicBackground")->middleware('auth');
Route::post('/profiles/show/job-background/fetch', "ProfileController@fetchShowJobBackground")->middleware('auth');


Route::middleware(['auth', 'user'])->group(function(){

    Route::get('/profile/user', "ProfileController@index");
    Route::post('/profile/update', "ProfileController@update");
    Route::get('/profiles/academic/fetch', "ProfileController@fetchAcademicBackground");
    Route::post('/profile/academic/store', "ProfileController@storeAcademicBackground");
    Route::post('/profile/academic/update', "ProfileController@updateAcademicBackground");
    Route::post('/profile/academic/delete', "ProfileController@deleteAcademicBackground");
    Route::post('/profiles/job-resume/store', "ProfileController@storeJobResume");
    Route::get('/profiles/job-background/fetch', "ProfileController@fetchJobBackground");
    Route::post('/profiles/job-background/store', "ProfileController@storeJobBackground");
    Route::post('/profile/job-background/update', "ProfileController@updateJobBackground");
    Route::post('/profile/job-background/delete', "ProfileController@deleteJobBackground");
    Route::post('/profiles/others/store', "ProfileController@storeOthers");
    Route::post("/profiles/validate-user", "ProfileController@validateUser");

});

Route::middleware(['auth', 'business'])->group(function(){

    Route::get('/profile/business', "ProfileController@businessIndex");
    Route::post('/profile/business/update', "ProfileController@businessUserBusinessUpdate");
    Route::post('/profile/business/business/update', "ProfileController@businessBusinessUpdate");

    Route::get("/offers/create", "OfferController@create");
    Route::post("/offers/store", "OfferController@store");

});

Route::get("/offers/fetch/{page}", "OfferController@userFetch")->middleware('auth');
Route::get("/offers/business/fetch/{page}", "OfferController@businessFetch")->middleware('auth')->middleware('business');
Route::get("/offers/detail/{slug}", "OfferController@show")->middleware('auth')->middleware('auth');

Route::post("/proposal/store", "ProposalController@store")->middleware('auth');
Route::post("/proposal/fetch", "ProposalController@fetch")->middleware('auth');
Route::get("/my-proposals", "ProposalController@index")->middleware('auth');
Route::get("/my-proposals/fetch/{page}", "ProposalController@myProposals")->middleware('auth');

Route::get("my-applies", "ProposalController@myAppliesView")->middleware('auth');
Route::get("/my-applies/fetch/{page}", "ProposalController@myApplies")->middleware('auth');

Route::get('plans/available', 'PlanController@index');

Route::post("/cart/store", "CartController@store")->middleware('auth')->middleware('business');

Route::post("/contract", "ContractController@store");

Route::get('/checkout/{cart}', 'CheckoutController@initTransaction')->name('checkout')->middleware('auth')->middleware('business');  
Route::post('/checkout/webpay/response', 'CheckoutController@response')->name('checkout.webpay.response');  
Route::post('/checkout/webpay/finish', 'CheckoutController@finish')->name('checkout.webpay.finish');

Route::get("/country/fetch", "CountriesController@fetch");

Route::get("/search", "SearchController@index");
Route::post("/search", "SearchController@search");

Route::get("/business/search", "SearchController@businessIndex");
Route::post("/business/search", "SearchController@businessSearch");

Route::get("/my-references", "JobReferenceController@index");
Route::get("/my-references/fetch", "JobReferenceController@fetch");
Route::get("/my-references/fetch-by-id/{id}", "JobReferenceController@fetchById");
Route::post("/my-references/store", "JobReferenceController@store");
Route::post("/my-references/update", "JobReferenceController@update");
Route::post("/my-references/delete", "JobReferenceController@delete");

/*Route::get("/usuario", function(){
    return view("users.usersView");
});

Route::get("/empresa", function(){
    return view("users.businessView");
});*/

Route::post("conference/schedule", "ConferenceController@store");

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

Route::get('/admin/offers', "AdminOfferController@index")->middleware('auth');
Route::get('/admin/offers/fetch/{page}', "AdminOfferController@fetch");
Route::post('/admin/offers/search', "AdminOfferController@search");

Route::get("/admin/landing-business", "LandingBusinessController@index");
Route::get("/admin/landing-business/fetch", "LandingBusinessController@fetch");
Route::post("/admin/landing-business/store", "LandingBusinessController@store");
Route::post("/admin/landing-business/update", "LandingBusinessController@update");
Route::post("/admin/landing-business/delete", "LandingBusinessController@delete");


Route::get("/admin/curriculum-validate", "CurriculumValidateController@index");
Route::get("/admin/curriculum-validate/fetch/{page}", "CurriculumValidateController@fetch");
Route::post("/admin/curriculum-validate/user", "CurriculumValidateController@approveCurriculum");

Route::get("/admin/about-us/index", "AboutUsController@index");
Route::post("/admin/about-us/update", "AboutUsController@update");


/*Route::post("/admin/landing-business/store", "LandingBusinessController@store");
Route::post("/admin/landing-business/update", "LandingBusinessController@update");
Route::post("/admin/landing-business/delete", "LandingBusinessController@delete");*/

/*Route::get('/admin/carousels', "AdminCarouselController@index")->middleware('auth');
Route::get('/admin/carousels/fetch', "AdminCarouselController@fetch");
Route::post('/admin/carousels/store', "AdminCarouselController@store");
Route::post('/admin/carousels/update', "AdminCarouselController@update");
Route::post('/admin/carousels/delete', "AdminCarouselController@delete");*/