<?php

use App\Http\Controllers\CommunityLinksController;
use App\Http\Controllers\VotesController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [CommunityLinksController::class, 'index'])->name('index');
Route::get('community', [CommunityLinksController::class, 'index'])->name('index');
Route::get('community/{channel:slug}', [CommunityLinksController::class, 'index'])
    ->name('filter.channel');

Route::middleware('auth')->group(function (){
    Route::post('community', [CommunityLinksController::class, 'store'])->name('community.store');
    Route::post('vote/{communityLink}', [VotesController::class, 'store'])->name('vote');
});
