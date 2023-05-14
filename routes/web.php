<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxonomyTermController;

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

// Route::statamic('example', 'example-view', [
//    'title' => 'Example'
// ]);

Route::get('/{taxonomy}/{term}', [TaxonomyTermController::class, 'create'])
        ->where('taxonomy', 'categories')        
        ->name('taxonomy-term.store');
