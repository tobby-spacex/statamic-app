<?php

use App\Http\Controllers\Api\CatalogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// To do: Protect routes
Route::get('/products-by-sap-codes', [CatalogController::class, 'index']);
Route::get('/products-by-sap-codes/{id}', [CatalogController::class, 'show']);
Route::post('/products-by-sap-codes', [CatalogController::class, 'store'])->name('sap_codes.store');