<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WebsiteController::class, 'index'])->name('index.page');
Route::get('/Ministries', [WebsiteController::class, 'ministry'])->name('ministry.page');
Route::get('/Sermons', [WebsiteController::class, 'sermon'])->name('sermons.page');
Route::get('/Events', [WebsiteController::class, 'event'])->name('events.page');
Route::get('/Contact-us', [WebsiteController::class, 'contact'])->name('contact.page');


Route::middleware('auth')->group(function () {
    Route::get('/create-content', [WebsiteController::class, 'create'])->name('content.create');
    Route::post('/create-content', [WebsiteController::class, 'store'])->name('content.store');
    Route::get('/edit-content-{id}', [WebsiteController::class, 'edit'])->name('content.edit');
    Route::patch('/update-content/{id}', [WebsiteController::class, 'update'])->name('content.update');
    Route::delete('/destroy-content/{id}', [WebsiteController::class, 'destroy'])->name('content.destroy');
    Route::get('/dashboard', [WebsiteController::class, 'dashboard'])->name('dashboard');
    Route::post('/file-upload', [WebsiteController::class, 'process'])->name('upload.process');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
