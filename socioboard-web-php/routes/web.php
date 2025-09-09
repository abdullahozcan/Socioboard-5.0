<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FileController;

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

Route::post('file/create', [FileController::class,'store']);
Route::post('file/destroy', [FileController::class,'destroy']);

Route::get('/', function () {
    return redirect('/dashboard');
});

// Authentication redirect - keeping for compatibility
Route::get('/login', function () {
    return view('auth.login');
});

Route::any('amember/member', function (){
    return redirect('/login');
});

// Livewire Routes for SocioBoard 5.0 - New Modern Interface
Route::prefix('livewire')->group(function() {
    Route::get('/dashboard', \App\Http\Livewire\Dashboard::class)->name('livewire.dashboard');
    Route::get('/social-accounts', \App\Http\Livewire\SocialAccounts::class)->name('livewire.social-accounts');
    Route::get('/content-studio', \App\Http\Livewire\ContentStudio::class)->name('livewire.content-studio');
    Route::get('/feeds', \App\Http\Livewire\FeedsManager::class)->name('livewire.feeds');
    Route::get('/reports', \App\Http\Livewire\ReportsManager::class)->name('livewire.reports');
});

// Redirect root to the new livewire dashboard
Route::get('/modern', function () {
    return redirect('/livewire/dashboard');
})->name('modern');
