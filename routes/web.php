<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\userController;
use App\Http\Controllers\playGroundController;
use App\Http\Controllers\productController;
use App\Http\Controllers\documentController;
use App\Http\Controllers\OrderModule\OrderModuleController;

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
Route::post("/checkLogin", [userController::class, "checkLogin"]);
Route::get("/logout", [userController::class, "logout"]);
Route::get("/forms", [playGroundController::class, "addForm"]);

Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/delete-document", [documentController::class, "deleteDocument"]);

Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/category", [categoryController::class, "viewCategory"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/category-add", [categoryController::class, "addCategoryForm"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/category-add-submit", [categoryController::class, "addCategoryFormData"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/category-edit-submit", [categoryController::class, "editCategoryFormData"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/category-edit/{id}", [categoryController::class, "editCategoryForm"]);

Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product", [productController::class, "viewProduct"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product-add", [productController::class, "addProductForm"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/product-add-submit", [productController::class, "addProductFormData"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/product-edit-submit", [productController::class, "editProductFormData"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product-edit/{id}", [productController::class, "editProductForm"]);

Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product-section-view", [productController::class, "viewProductSection"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product-section-status/{id}", [productController::class, "changeStatus"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/product-section-add", [productController::class, "addProductSectionForm"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/product-section-submit", [productController::class, "createSection"]);


Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/order-section-view", [OrderModuleController::class, "getOrderView"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/order-section-status/{id}", [OrderModuleController::class, "changeStatus"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->get("/order-section-add", [productController::class, "addProductSectionForm"]);
Route::middleware(["checkIsAuth"])->middleware("setActivePage")->post("/order-section-submit", [productController::class, "createSection"]);
