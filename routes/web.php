<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MisterFileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileMovementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SectionAssignmentController;
use App\Http\Controllers\Reportcontroller;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\OtpVerified;
use App\Http\Middleware\SuperAdmin;

Route::get('clear', function () {
     // Clear application cache
     Artisan::call('config:clear');
     Artisan::call('cache:clear');
     Artisan::call('route:clear');
     Artisan::call('view:clear');
     Artisan::call('optimize:clear');

     // Additional optimization commands if needed
     // Artisan::call('config:cache');
     // Artisan::call('route:cache');
     // Artisan::call('event:cache');

     return 'Cache cleared and optimized successfully.';
});

Route::get('testing', function(){
    return  redirect()->route('mydesk',['id'=>'123']);
});
Route::get('/', function () {
    return  redirect()->route('login');
});
//Route::get('/dashboardd', [DashboardController::class, 'index'])->name('dashboardd');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@sendLoginLink')->name('login.send.link');
Route::get('/login/{user}', 'App\Http\Controllers\Auth\LoginController@loginWithLink')->name('login.with.link');
// routes/web.php
Route::get('/verify-otp', 'App\Http\Controllers\Auth\LoginController@showVerifyForm')->name('otp.verify');
Route::get('/otp-resend', 'App\Http\Controllers\Auth\LoginController@showVerifyResend')->name('otp.verify.resend');
Route::post('/verify-otp', 'App\Http\Controllers\Auth\LoginController@verify')->name('otp.verify.submit');


Route::middleware('auth',OtpVerified::class)->group(function () {
    Route::get('/dashboardd', [DashboardController::class, 'index'])->name('dashboardd');
    Route::get('/dashboard/files', [DashboardController::class, 'files'])->name('dashboard.files');
    Route::get('/dashboard/letters', [DashboardController::class, 'letters'])->name('dashboard.letters');
    Route::get('/dashboard/notesheet', [DashboardController::class, 'notesheet'])->name('dashboard.notesheet');


    // Reports
    Route::get('search/open', [Reportcontroller::class, 'openSearch'])->name('open.search');
    Route::get('report/advance', [Reportcontroller::class, 'reportAdvance'])->name('report.advance');
    Route::get('report/sectionwises/{type}/{status}', [Reportcontroller::class, 'sectionWise'])->name('report.sectionwises');
});




Route::get('/assign-sections/list', [SectionAssignmentController::class, 'index'])->name('assign.sections.list');
Route::get('/assign-sections', [SectionAssignmentController::class, 'showAssignForm'])->name('assign.sections.form');
Route::post('/assign-sections', [SectionAssignmentController::class, 'assignSections'])->name('assign.sections');
Route::get('/edit-sections/{user}', [SectionAssignmentController::class, 'editSections'])->name('edit.user.sections');
Route::post('/update-sections/{user}', [SectionAssignmentController::class, 'updateSections'])->name('update.user.sections');




Route::middleware('auth',OtpVerified::class,SuperAdmin::class)->group(function(){

    Route::get('report/performance/section', [Reportcontroller::class, 'sectionPerformance'])->name('report.performance.section');

    Route::get('report/performance/user', [Reportcontroller::class, 'userPerformance'])->name('report.performance.user');

    Route::get('report/performance/user/single', [Reportcontroller::class, 'ReportuserPerformance'])->name('report.performance.user.single');
    // Assign Section


     // sections
     Route::resource('/sections', SectionController::class);
     Route::resource('/users', UsersController::class);
     Route::get('/report', [DashboardController::class, 'report'])->name('report');
     Route::get('/report/section/{section}/{type}', [DashboardController::class, 'reportSetionType'])->name('report.section');
});

Route::middleware('auth',OtpVerified::class)->group(function () {


    // Ajax Search For File

    Route::get('/file/file_no_search', [FileController::class, 'fileNoSearch'])->name('file.file_no_search');

    // mister File
    Route::resource('/masterfile', MisterFileController::class);
    Route::resource('/file', FileController::class)->except(['create']);
    Route::get('file/create/{type}', [FileController::class, 'create'])->name('file.create');
    Route::post('/file/store/letter', [FileController::class, 'letter_store'])->name('file.store.letter');
    Route::post('/file/store_file', [FileController::class, 'store_file'])->name('file.store_file');
    Route::post('/file/store_letter', [FileController::class, 'store_letter'])->name('file.store_letter');
    Route::post('/file/store_notesheet', [FileController::class, 'store_notesheet'])->name('file.store_notesheet');
    Route::post('/file/store_reminder', [FileController::class, 'store_reminder'])->name('file.store_reminder');
    Route::post('forword/store_reply/{id}', [FileController::class, 'store_reply'])->name('file.store_reply');
    Route::get('forword/reply/{id}', [FileController::class, 'reply'])->name('file.reply');
    // Out Bound
    Route::get('/myfile/outbound/file', [FileController::class, 'fileOutBound'])->name('myfile.outbound.file');
    Route::get('/myfile/outbound/letter', [FileController::class, 'letterOutBound'])->name('myfile.outbound.letter');

    // for daynamic load
    Route::get('/sections/by-source', [SectionController::class, 'getSectionsBySource'])->name('sections.bySource');

    Route::get('sections/users/{id}', [SectionController::class, 'getUsersBySection'])->name('sections.users');


    Route::get('/myfile/create', [FileController::class, 'createlist'])->name('myfile.create');
    Route::get('/myfile/inprocess', [FileController::class, 'inprocesslist'])->name('myfile.inprocess');
    Route::get('/myfile/disposed', [FileController::class, 'disposedlist'])->name('myfile.disposed');
    Route::get('/myfile/intransit', [FileController::class, 'intransit'])->name('myfile.intransit');

    Route::get('/forword/create/{id}', [FileMovementController::class, 'create'])->name('forword.create');
    Route::get('/forword/inprocess/{id}', [FileMovementController::class, 'inprocess'])->name('forword.inprocess');
    Route::get('/forword/desposed/{id}', [FileMovementController::class, 'desposed'])->name('forword.desposed');
    Route::post('/forword/desposed/{id}/store', [FileMovementController::class, 'desposed_store'])->name('forword.desposed.store');

    Route::get('/track/show/history/{id}', [FileMovementController::class, 'show_history'])->name('track.show.history');
    Route::get('/track/show/{id}', [FileMovementController::class, 'show'])->name('track.show');
    Route::get('/track/show/byreference/{reference}', [FileMovementController::class, 'byreference'])->name('track.show.byreference');
    Route::resource('forword', FileMovementController::class)->except(['create', 'show']);


    // forword
    Route::get('forword/attachtofile/{id}', [FileMovementController::class, 'attachtofile'])->name('forword.attachtofile');
    // Route::post('forword/attachtofile/{id}', [FileMovementController::class,'attachtofile_post'])->name('forword.attachtofile');
    // desposed
    Route::get('forword/createfile/{id}', [FileMovementController::class, 'createfile'])->name('forword.createfile');
    Route::post('forword/createfile/{id}', [FileMovementController::class, 'createfile_post'])->name('forword.createfile');
    Route::post('forword/attachtofile/{id}', [FileMovementController::class, 'attachtofile_post'])->name('forword.attachtofile');
    Route::post('forword/forword/{id}', [FileMovementController::class, 'forword_post'])->name('forword.forword');




    // Route::view('/intransit', 'intransit.index');
    Route::get('/mydesk', [FileController::class, 'mydesk'])->name('mydesk');
    // Route::get('/intransit', [FileController::class,'intransit'])->name('intransit');
    Route::view('/search', 'search.index');
    Route::view('/track', 'file.track');
    Route::view('/forword', 'file.forword');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/notifications', [FirebaseController::class, 'notifications'])->name('notifications');
    Route::get('/firebase-config', [FirebaseController::class, 'config'])->name('firebase.config');
    Route::post('/store-fcm-token', [FirebaseController::class, 'storeToken'])->name('store-fcm-token');
    Route::get('/sendnotification', [FirebaseController::class, 'sendNotification'])->name('sendnotification');


    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])

        ->name('logout');
});

// require __DIR__.'/auth.php';
