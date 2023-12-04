<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\StoreController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/* Registeration Routes */
Route::post('register', [RegistrationController::class, 'register']);
Route::post('otp_verify', [RegistrationController::class, 'otp_verify']);
Route::post('login', [RegistrationController::class, 'login']);
Route::get('anime_list',[RegistrationController::class, 'anime_list']);




// Route::post('store_login', [RegistrationController::class, 'store_login']);
// Route::post('resend_otp', [RegistrationController::class, 'resend_otp']);
// Route::post('social_login', [RegistrationController::class, 'social_login']);
// Route::post('get_employee', [RegistrationController::class, 'get_employee']);
// Route::post('forgot_password', [RegistrationController::class, 'forgot_password']);
// Route::post('reset_password', [RegistrationController::class, 'reset_password']);




// /* Registeration Routes */

Route::middleware(['auth:api'])->group(function () {

    Route::post('anime_by_id',[RegistrationController::class, 'get_anime_list_by_id']);
Route::post('delete_from_watch_later', [RegistrationController::class, 'delete_from_watch_later']);
Route::post('delete_from_favourite', [RegistrationController::class, 'delete_from_favourite']);
Route::post('delete_from_saved', [RegistrationController::class, 'delete_from_saved']);

    Route::post('logout', [RegistrationController::class, 'logout']);
    Route::post('saved_to_watch_later', [RegistrationController::class, 'saved_to_watch_later']);
    Route::post('saved_to_favourite', [RegistrationController::class, 'saved_to_favourite']);
    Route::post('save_anime', [RegistrationController::class, 'save_anime']);



    Route::get('get_profile', [RegistrationController::class, 'get_profile']);
    Route::post('edit_profile', [RegistrationController::class, 'edit_profile']);
    Route::post('change_password', [RegistrationController::class, 'change_password']);
    Route::get('get_saved_to_watch_later',[RegistrationController::class,'get_saved_to_watch_later']);
    Route::get('get_from_favourite',[RegistrationController::class,'get_from_favourite']);

    Route::get('get_saved_anime',[RegistrationController::class,'get_saved_anime']);


    // Route::post('get_products',[Productcontroller::class, 'getProducts']);
    // Route::get('product_detail', [Productcontroller::class, 'productDetail']);
    // Route::post('filter_product', [Productcontroller::class, 'filter_product']);
    // Route::post('get_product', [Productcontroller::class, 'get_product']);
    // Route::get('new_product',[Productcontroller::class, 'new_product']);
    // Route::post('search_product',[Productcontroller::class, 'search_product']);

    // Route::post('add_address', [AddressController::class, 'addAddress']);
    // Route::get('get_address', [AddressController::class, 'get_address']);
    // Route::post('edit_address', [AddressController::class, 'editAddress']);
    // Route::post('delete_address', [AddressController::class, 'deleteAddress']);
    // Route::post('add_to_cart', [CartController::class, 'addToCart']);
    // Route::get('get_cart', [CartController::class, 'getCart']);
    // Route::post('placed_order', [OrderController::class, 'placedOrder']);
    // Route::get('get_order', [OrderController::class, 'get_order']);
    // Route::post('return_order', [OrderController::class, 'return_order']);
    // Route::post('get_order_detail', [OrderController::class, 'get_order_detail']);
    // Route::post('cancel_order', [OrderController::class, 'cancel_order']);
    // Route::get('collected_points', [OrderController::class, 'get_collected_data']);
    // Route::post('points_used', [OrderController::class, 'points_used']);
    // Route::post('store_used_point',[StoreController::class, 'store_used_points']);
    // Route::get('get_articles', [ArticleController::class, 'get_articles']);
    // Route::post('get_article_detail', [ArticleController::class, 'article_detail']);
    // Route::get('get_category', [CategoryController::class, 'get_categories']);
    // Route::get('get_points',[OrderController::class, 'get_points']);
    Route::post('delete_account',[RegistrationController::class, 'delete_account']);
    







    
});
