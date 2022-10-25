<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\userController;
use App\Http\Controllers\playGroundController;
use App\Http\Controllers\productController;
use App\Http\Controllers\documentController;

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
    return view('panel.login');
});
Route::post("/checkLogin",[userController::class,"checkLogin"]);
Route::get("/logout",[userController::class,"logout"]);
Route::get("/forms",[playGroundController::class,"addForm"]);

Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/delete-document",[documentController::Class,"deleteDocument"]);

Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/category",[categoryController::Class,"viewCategory"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/category-add",[categoryController::Class,"addCategoryForm"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/category-add-submit",[categoryController::Class,"addCategoryFormData"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/category-edit-submit",[categoryController::Class,"editCategoryFormData"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/category-edit/{id}",[categoryController::Class,"editCategoryForm"]);

Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product",[productController::Class,"viewProduct"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product-add",[productController::Class,"addProductForm"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/product-add-submit",[productController::Class,"addProductFormData"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/product-edit-submit",[productController::Class,"editProductFormData"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product-edit/{id}",[productController::Class,"editProductForm"]);

Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product-section",[productController::Class,"sectionProduct"]);

