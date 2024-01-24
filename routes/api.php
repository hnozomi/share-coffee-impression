<?php

use App\Http\Controllers\CoffeeImpressionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// sanctum使うと認証されないのでauth:apiを使用
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


//フロントからのリクエストを受けて、どのコントローラを実行するか記述している
// その時に名前をつけている
// 名前をつけることでController側からその名前で呼び出すことができる

//Route::post('/auth/signup', [UserController::class, 'signup'])->name('signup');
//Route::post('/auth/login', [UserController::class, 'login'])->name('login');

// コーヒーの感想一覧を取得
Route::get('/coffee_impression', [CoffeeImpressionController::class, 'fetchAllCoffeeImpression'])->name('fetchAllCoffeeImpression');
// コーヒーの感想一覧を追加
Route::post('/coffee_impression/add', [CoffeeImpressionController::class, 'addCoffeeImpressions'])->name('addCoffeeImpressions');
// 選択されたコーヒーの感想を取得
Route::get('/coffee_impression/edit/{coffee_impression_id}', [CoffeeImpressionController::class, 'fetchOnlyCoffeeImpression'])->name('fetchOnlyCoffeeImpression');
// コーヒーの感想を更新
Route::put('/coffee_impression/update/{coffee_impression_id}', [CoffeeImpressionController::class, 'updateCoffeeImpression'])->name('updateCoffeeImpression');
// コーヒーの感想を削除
Route::delete('/coffee_impression/delete/{coffee_impression_id}', [CoffeeImpressionController::class, 'deleteCoffeeImpression'])->name('deleteCoffeeImpression');

