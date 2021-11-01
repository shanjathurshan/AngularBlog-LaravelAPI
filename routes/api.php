<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
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
// Route::resource('/products',ProductController::class);

//Public router
Route::get('/loggedInUser',[AuthController::class,'loggedInUser']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::delete('/users/{id}',[AuthController::class,'destroy']);
Route::post('/logout', [AuthController::class,'logout']);
Route::get('/getById/{id}',[AuthController::class,'getById']);

Route::get('/products',[ProductController::class,'index']);
Route::get('/products/search/{name}',[ProductController::class,'search']);
Route::post('/products', [ProductController::class,'createProduct']);
Route::put('/products/{id}',[ProductController::class,'update']);
Route::delete('/products/{id}',[ProductController::class,'destroy']);
Route::get('/products/{id}',[ProductController::class,'getProductById']);

Route::get('/create',[OrdersController::class,'create']);


//Protected router
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::post('/products', [ProductController::class,'store']);
    // Route::put('/products/{id}',[ProductController::class,'update']);
    // Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::get('/users',[AuthController::class,'index']);
    // Route::post('/logout', [AuthController::class,'logout']);
});

// Route::get('/products/{id}', function(Request $request, $id){
//     $data = Product::find($id);
//     $data->name = '$request->name';
//     $data->slug = '$request->slug';
//     $data->description = '$request->description';
//     $data->price = '$request->price';
//     return $data;
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
