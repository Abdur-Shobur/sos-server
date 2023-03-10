<?php
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories');
Route::get('category/add', [CategoryController::class, 'add'])->name('admin.category.add');
Route::post('category/store', [CategoryController::class, 'Store'])->name('admin.category.store');
Route::get('category/edit/{id}', [CategoryController::class, 'Edit'])->name('admin.category.edit');
Route::post('category/update/{id}', [CategoryController::class, 'Update'])->name('admin.category.update');
Route::get('category/delete/{id}', [CategoryController::class, 'Delete'])->name('admin.category.delete');
