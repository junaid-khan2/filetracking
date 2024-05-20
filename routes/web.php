<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MisterFileController;

Route::get('/', function () {
    return  redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {

    // mister File
    Route::resource('/misterfile',MisterFileController::class);
    Route::view('/file/create', 'file.create');
    Route::view('/intransit', 'intransit.index');
    Route::view('/mydesk', 'mydesk.index');
    Route::view('/search', 'search.index');
    Route::view('/track', 'file.track');
    Route::view('/forword', 'file.forword');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
