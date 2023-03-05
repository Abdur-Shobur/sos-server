<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\VendorAuthController;
use App\Http\Controllers\API\AffiliatorAuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\Vendor\VendorController;

use Illuminate\Support\Facades\Route;

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


//vendor route
Route::post('vendor/register', [VendorAuthController::class, 'VendorRegister']);
Route::post('vendor/login', [VendorAuthController::class, 'VendorLogin']);

//affiliator route
Route::post('affiliator/register', [AffiliatorAuthController::class, 'AffiliatorRegister']);
Route::post('affiliator/login', [AffiliatorAuthController::class, 'AffiliatorLogin']);




Route::post('register', [AuthController::class, 'Register']);
Route::post('admin/login', [AuthController::class, 'Login']);




Route::middleware(['auth:sanctum','isAPIVendor'])->group(function(){
  Route::get('/checkingAuthenticatedVendor', function () {
      return response()->json(['message'=>'You are in', 'status'=>200], 200);
});

     Route::get('vendor/profile',[VendorController::class,'VendorProfile']);
     Route::post('vendor/update/profile',[VendorController::class,'VendorUpdateProfile']);
     Route::get('vendor/product',[VendorController::class,'VendorProduct']);
    Route::post('vendor-store-product',[VendorController::class,'VendorProductStore']);
    Route::get('vendor-edit-product/{id}',[VendorController::class,'VendorProductEdit']);
    Route::put('vendor-update-product/{id}', [VendorController::class, 'VendotUpdateProduct']);
    Route::delete('vendor-delete-product/{id}', [VendorController::class, 'VendorDelete']);

    Route::get('vendor-all-category', [VendorController::class, 'AllCategory']);
    Route::get('vendor-all/brand', [VendorController::class, 'AllBrand']);




});




Route::middleware(['auth:sanctum','isAPIAdmin'])->group(function(){

    Route::get('/checkingAuthenticated', function () {
        return response()->json(['message'=>'You are in', 'status'=>200], 200);

  });
  Route::get('admin/profile',[AdminController::class,'AdminProfile']);
  Route::post('admin/update/profile',[AdminController::class,'AdminUpdateProfile']);



  Route::post('store-category',[CategoryController::class,'CategoryStore']);
  Route::get('view-category',[CategoryController::class,'CategoryIndex']);
  Route::get('edit-category/{id}',[CategoryController::class,'CategoryEdit']);
  Route::post('update-category/{id}', [CategoryController::class, 'UpdateCategory']);
  Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);

 // Route::get('all/category', [CategoryController::class, 'AllCategory']);


  //subcategory route
Route::post('store-subcategory',[SubCategoryController::class,'SubCategoryStore']);
Route::get('view-subcategory',[SubCategoryController::class,'SubCategoryIndex']);
Route::get('edit-subcategory/{id}',[SubCategoryController::class,'SubCategoryEdit']);
Route::post('update-subcategory/{id}', [SubCategoryController::class, 'UpdateSubCategory']);
Route::delete('delete-subcategory/{id}', [SubCategoryController::class, 'destroy']);




   Route::post('store-brand',[BrandController::class,'BrandStore']);
   Route::get('view-brand',[BrandController::class,'BrandIndex']);
   Route::get('edit-brand/{id}',[BrandController::class,'BrandEdit']);
   Route::put('update-brand/{id}', [BrandController::class, 'BrandUpdate']);
   Route::delete('delete-brand/{id}', [BrandController::class, 'destroy']);



    Route::get('all-category', [ProductController::class, 'AllCategory']);
    Route::get('all/brand', [ProductController::class, 'AllBrand']);

    Route::post('store-product',[ProductController::class,'ProductStore']);
    Route::get('view-product',[ProductController::class,'ProductIndex']);
    Route::get('edit-product/{id}',[ProductController::class,'ProductEdit']);
    Route::put('update-product/{id}', [ProductController::class, 'UpdateProduct']);
    Route::delete('delete-product/{id}', [ProductController::class, 'destroy']);


    Route::get('vendor/view', [UserController::class, 'VendorView']);
    Route::post('vendor/store', [UserController::class, 'VendorStore']);
    Route::get('edit-vendor/{id}',[UserController::class,'VendorEdit']);
    Route::post('update-vendor/{id}', [UserController::class, 'UpdateVendor']);
    Route::delete('delete-vendor/{id}', [UserController::class, 'VendorDelete']);

    Route::post('affiliator/store', [UserController::class, 'AffiliatorStore']);
    Route::get('affiliator/view', [UserController::class, 'AffiliatorView']);
    Route::get('edit/affiliator/{id}', [UserController::class, 'AffiliatorEdit']);
    Route::post('update-affiliator/{id}', [UserController::class, 'UpdateAffiliator']);
    Route::delete('delete-affiliator/{id}', [UserController::class, 'AffiliatorDelete']);

});



Route::middleware(['auth:sanctum'])->group(function(){
   Route::post('logout',[AuthController::class,'logout']);
  });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
