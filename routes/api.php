<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\documentController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\productController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\addressController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\orderController;
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

// user api

Route::get("/user", [userController::class, "getUser"]);
Route::post("/user/add", [userController::class, "addUser"]);
Route::post("/user/update", [userController::class, "editUser"]);

// product api
Route::get("/product", [productController::class, "getProduct"]);
Route::get("/product/{id}", [productController::class, "getProductById"]);
Route::get("/cat-product/{cid}", [productController::class, "getProductByCatId"]);
Route::post("/product/add", [productController::class, "addProduct"]);
Route::post("/product/update", [productController::class, "updateProduct"]);

// category api
Route::get("/category", [categoryController::class, "getCategory"]);
Route::post("/category/add", [categoryController::class, "addCategory"]);
Route::post("/category/update", [categoryController::class, "updateCategory"]);

// document
Route::get("/get/document", [documentController::class, "getDocument"]);
Route::get("/document/{label}", [documentController::class, "getDocumentByLabel"]);
Route::post("/add/document", [documentController::class, "addDocument"]);

Route::get("/product-section", [productController::class, "sectionProduct"]);
Route::get("/getSection/{id}", [productController::class, "sectionProductById"]);

Route::post("/client/register", [clientController::class, "addUser"]);
Route::post("/client/checkUser", [clientController::class, "getUser"]);

Route::post("/client/getUserAddress", [addressController::class, "getUserAddress"]);
Route::get("/getfooter", [addressController::class, "getFooter"]);
Route::post("/client/addUserAddress", [addressController::class, "addUserAddress"]);

Route::post("/order/placeOrder", [orderController::class, "placeOrder"]);
Route::post("/order/getOrder", [orderController::class, "getOrder"]);

Route::get("/getConfig", [ConfigController::class, "getConfig"]);
