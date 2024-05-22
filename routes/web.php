<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MisterFileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileMovementController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return  redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::get('/report', [DashboardController::class,'report'])->name('report');
Route::get('/report/section/{section}/{type}', [DashboardController::class,'reportSetionType'])->name('report.section');




Route::middleware('auth')->group(function () {

    // mister File
    Route::resource('/masterfile',MisterFileController::class);
    Route::resource('/file',FileController::class);
    Route::get('/myfile/create',[FileController::class,'createlist'])->name('myfile.create');
    Route::get('/myfile/inprocess',[FileController::class,'inprocesslist'])->name('myfile.inprocess');
    Route::get('/myfile/disposed',[FileController::class,'disposedlist'])->name('myfile.disposed');
    Route::get('/myfile/intransit',[FileController::class,'intransit'])->name('myfile.intransit');

    Route::get('/forword/create/{id}',[FileMovementController::class,'create'])->name('forword.create');
    Route::get('/forword/inprocess/{id}',[FileMovementController::class,'inprocess'])->name('forword.inprocess');
    Route::get('/forword/desposed/{id}',[FileMovementController::class,'desposed'])->name('forword.desposed');

    Route::get('/track/show/{id}',[FileMovementController::class,'show'])->name('track.show');
    Route::resource('forword', FileMovementController::class)->except(['create','show']);

    // Route::view('/intransit', 'intransit.index');
    Route::get('/mydesk', [FileController::class,'mydesk'])->name('mydesk');
    // Route::get('/intransit', [FileController::class,'intransit'])->name('intransit');
    Route::view('/search', 'search.index');
    Route::view('/track', 'file.track');
    Route::view('/forword', 'file.forword');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
