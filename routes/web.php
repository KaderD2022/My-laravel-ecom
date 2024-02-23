<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/' , [ClientController::class, 'home' ]);
Route::get('/shop' , [ClientController::class, 'shop' ]);
Route::get('/cart' , [ClientController::class, 'cart' ]);
Route::put('/cart/updateqty/{id}' , [ClientController::class, 'updateqty' ]);
Route::get('/cart/remoteitem/{id}' , [ClientController::class, 'remoteitem' ]);
Route::get('/checkout' , [ClientController::class, 'checkout' ]);
Route::get('/account' , [ClientController::class, 'account' ]);
Route::get('/sign' , [ClientController::class, 'sign' ]);
Route::post('/createaccount' , [ClientController::class, 'createaccount' ]);
Route::post('/accessaccount' , [ClientController::class, 'accessaccount' ]);
Route::get('/addtocart/{id}' , [ClientController::class, 'addtocart' ]);
Route::get('/logout' , [ClientController::class, 'logout' ]);
Route::any('/payer' , [ClientController::class, 'payer' ]);
Route::get('/paymentSuccess' , [ClientController::class, 'paymentSuccess' ]);



Route::get('/admin' , [AdminController::class, 'admin' ]);
Route::get('/admin/addcategory' , [AdminController::class, 'addcategory' ]);
Route::get('/admin/addproduct' , [AdminController::class, 'addproduct' ]);
Route::get('/admin/addslider' , [AdminController::class, 'addslider' ]);
Route::get(' /admin/category' , [AdminController::class, 'category' ]);
Route::get('/admin/orders' , [AdminController::class, 'orders' ]);
Route::get('/admin/product' , [AdminController::class, 'product' ]);
Route::get('/admin/slider' , [AdminController::class, 'slider' ]);





Route::post('/admin/savecategory' , [CategoryController::class, 'savecategory' ]);
Route::get('/admin/editcategory/{id}' , [CategoryController::class, 'editcategory' ]);
Route::delete('/admin/deletecategory/{id}' , [CategoryController::class, 'deletecategory' ]);
Route::put('admin/updatecategory/{id}' , [CategoryController::class, 'updatecategory' ]);



Route::post('/admin/saveslider' , [SliderController::class, 'saveslider' ]);
Route::get('/admin/editslider/{id}' , [SliderController::class, 'editslider' ]);
Route::delete('/admin/deleteslider/{id}' , [SliderController::class, 'deleteslider' ]);
Route::put('/admin/updateslider/{id}' , [SliderController::class, 'updateslider' ]);
Route::put('/admin/unactivateslider/{id}' , [SliderController::class, 'unactivateslider' ]);
Route::put('/admin/activateslider/{id}' , [SliderController::class, 'activateslider' ]);


Route::post('/admin/saveproduct' , [ProductController::class, 'saveproduct' ]);
Route::get('/admin/editproduct/{id}' , [ProductController::class, 'editproduct' ]);
Route::delete('/admin/deleteproduct/{id}' , [ProductController::class, 'deleteproduct' ]);
Route::put('/admin/updateproduct/{id}' , [ProductController::class, 'updateproduct' ]);
Route::put('/admin/unactivateproduct/{id}' , [ProductController::class, 'unactivateproduct' ]);
Route::put('/admin/activateproduct/{id}' , [ProductController::class, 'activateproduct' ]);




Route::get('/seeorders/{id}' , [PdfController::class, 'seeorders' ]);



