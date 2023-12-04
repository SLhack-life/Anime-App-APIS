<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SallaryController;
use App\Http\Controllers\sub_SubCategoryController;
use Maatwebsite\Excel\Row;

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
})->name('logina'); 
Auth::routes();
Route::get('/forgot_password', [App\Http\Controllers\Usercontroller::class, 'forgot_password'])->name('forgot_password');

Route::get('privacy_policy',[App\Http\Controllers\PrivacyController::class, 'show_privacy']);
Route::get('terms-and-conditions',[App\Http\Controllers\PrivacyController::class, 'termsAndConditions']);
Route::get('/fetch-and-save-anime', [Usercontroller::class, 'fetchAndSaveAnimeData']);

  Route::group(['middleware' => 'auth:web'], function () {


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('user_list', [App\Http\Controllers\Usercontroller::class, 'user_list'])->name('user_list');
Route::get('/user_view', [App\Http\Controllers\Usercontroller::class, 'getUserDetails'])->name('getUserDetails');
// Change Passsword
Route::get('/change_password', [App\Http\Controllers\Usercontroller::class, 'change_password'])->name('change_password');
// change_password_user
Route::post('/change_password_user', [App\Http\Controllers\Usercontroller::class, 'change_password_user'])->name('change_password_user');

Route::post('forget-password', [App\Http\Controllers\Usercontroller::class, 'submitForgetPasswordForm']);
Route::get('reset-password/{token}',[App\Http\Controllers\Usercontroller::class, 'showResetPasswordForm']);
Route::post('submit_reset_pasword',[App\Http\Controllers\Usercontroller::class, 'submitResetPasswordForm']);
Route::get('/dashboard', [App\Http\Controllers\Dashboardcontroller::class, 'dashboard'])->name('dashboard');
Route::get('forgot_password/{id}', [HomeController::class, 'forgot_password']);
Route::post('password_forgot', [HomeController::class,'password_forgot']);
Route::get('/categories', [Categorycontroller::class, 'index'])->name('index');
Route::post('add/category', [Categorycontroller::class, 'store']);
Route::post('delete/category', [Categorycontroller::class, 'delete_category']);

Route::post('edit/category', [Categorycontroller::class, 'edit_category']);

Route::get('/category_view/{id}', [Categorycontroller::class, 'show'])->name('show');
Route::get('sub_category_view/{id}', [SubCategoryController::class, 'view']);
Route::get('sub_category', [SubCategoryController::class, 'show']);
Route::post('add/sub_category', [SubCategoryController::class, 'store']);
Route::post('edit/subcategory', [SubCategoryController::class, 'edit']);
Route::post('update/sub_category', [SubCategoryController::class, 'update']);
Route::post('delete/sub_category', [SubCategoryController::class, 'delete']);
Route::post('delete/sub_sub_category', [sub_SubCategoryController::class, 'delete']);
Route::get('sub_subcategory', [sub_SubCategoryController::class, 'show']);
Route::get('sub_sub_category_view/{id}', [sub_SubCategoryController::class, 'view']);
Route::post('add/sub_sub_category', [sub_SubCategoryController::class, 'store']);
Route::post('edit/sub_subcategory',[sub_SubCategoryController::class, 'edit']);
Route::post('edite/category',[Categorycontroller::class, 'edite']);
Route::post('update/sub_sub_category', [sub_SubCategoryController::class, 'update']);
Route::get('products', [Productcontroller::class, 'index'])->name('productAll');
// product view show
Route::get('product_view/{id}', [Productcontroller::class, 'show'])->name('show');
Route::get('articles_view', [ArticleController::class, 'show']);
Route::post('add/article', [ArticleController::class, 'add_article_data']);
Route::post('view/article', [ArticleController::class, 'view_article']);
Route::post('edit/article', [ArticleController::class, 'edit_article']);
Route::post('update/article',[ArticleController::class, 'update_article']);
Route::post('delete/article',[ArticleController::class, 'delete_article']);



Route::get('orders', [OrderController::class, 'show'])->name('orders');
Route::get('order_view/{id}', [OrderController::class, 'view_order']);
Route::get('complete_order', [OrderController::class, 'show_complete_orders'])->name('complete_order');
Route::get('order_view/{id}', [OrderController::class, 'view_complete']);

Route::post('update_order_status', [OrderController::class, 'update_status']);


// dumuy
// Route::get('product', [Productcontroller::class, 'showdata'])->name('showdata');
// Add Product
Route::post('add_product', [CategoryController::class, 'add_product_data'])->name('add_product_data');
//changestatus
Route::post('change_status', [Usercontroller::class, 'change_status_update']);
Route::post('change_points',[Usercontroller::class, 'edit_points']);
Route::post('change_points_value',[Usercontroller::class, 'change_points_value']);
Route::post('edit_user', [Usercontroller::class, 'edit']);
Route::post('user/update', [Usercontroller::class, 'update']);
Route::post('add/product', [Productcontroller::class, 'addProduct']);
Route::post('edit/product', [Productcontroller::class, 'editProduct']);
Route::get('stores_list', [App\Http\Controllers\StoreController::class, 'stores_list'])->name('stores_list');
Route::post('add/store',[App\Http\Controllers\StoreController::class, 'add_store']);
Route::post('edit/store',[App\Http\Controllers\StoreController::class, 'edit_store']);
Route::post('update/store',[App\Http\Controllers\StoreController::class, 'update_store']);
Route::post('delete/product_imgs',[Productcontroller::class, 'delete_product_images']);
Route::post('delete/product',[Productcontroller::class, 'delete_product']);
Route::post('delete/product_var_imgs',[Productcontroller::class, 'delete_var_images']);
Route::post('show/product_var_info',[Productcontroller::class, 'product_var_info']);
Route::get('sallary_manage',[SallaryController::class, 'show_sallary']);
Route::post('add_worker',[SallaryController::class, 'add_worker']);



Route::resource('items', Categorycontroller::class);


Route::get('/file-import',[Usercontroller::class,
'importView'])->name('import-view'); 
Route::post('/import',[Usercontroller::class,
'import'])->name('import'); 

//  });

  });