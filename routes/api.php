<?php
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//API for Show
Route::get('/roles/{id}',[RoleController::class,'show']);
Route::get('/users/{id}',[UserController::class,'show']);

//API for Create
Route::post('/role',[RoleController::class,'store']);
Route::post('/user',[UserController::class,'store']);

//API for Read
Route::get('/roles',[RoleController::class,'index']);
Route::get('/users',[UserController::class,'index']);

//API for update
Route::put('/roles/{id}',[RoleController::class,'update']);
Route::put('/users/{id}',[UserController::class,'update']);

//API for delete
Route::delete('/roles/{id}',[RoleController::class,'destroy']);
Route::delete('/users/{id}',[UserController::class,'destroy']);

//API for login
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);