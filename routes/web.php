<?php

use App\Http\Controllers\ArchivesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Conference_CategoriesController;
use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Editorial_board;
use App\Http\Controllers\Editorial_boardController;
use App\Http\Controllers\IndexController;

// Main Page Route
// Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');

// Indexing
Route::get('index', [IndexController::class, "index"])->name("index-home")->middleware('auth');
Route::get('index/create', [IndexController::class, "create"])->name('index-create')->middleware('auth');
Route::post('index/store', [IndexController::class, "store"])->name('index-store')->middleware('auth');
Route::delete('index/{id}', [IndexController::class, "destroy"])->name('index-delete')->middleware('auth');
Route::put('index/{id}/toggle', [IndexController::class, 'toggleStatus'])->name('indexing.toggle')->middleware('auth');


// Editorial
Route::get('editorialboard', [Editorial_boardController::class, "index"])->name("editorial-home")->middleware('auth');
Route::get('editorialboard/create', [Editorial_boardController::class, "create"])->name("editorial-create")->middleware('auth');
Route::post('editorialboard/store', [Editorial_boardController::class, "store"])->name('editorial-store')->middleware('auth');
Route::put('editorialboard/edit/{id}', [Editorial_boardController::class, "edit"])->name('editorial-edit')->middleware('auth');
Route::put('editorialboard/update/{id}', [Editorial_boardController::class, "update"])->name('editorial-update')->middleware('auth');
Route::delete('editorialboard/{id}', [Editorial_boardController::class, "destroy"])->name('editorial-delete')->middleware('auth');


// Archives
Route::get('archivesboard', [ArchivesController::class, "index"])->name("archives-home")->middleware('auth');
Route::get('archivesboard/create', [ArchivesController::class, "create"])->name("archives-create")->middleware('auth');
Route::post('archivesboard/store', [ArchivesController::class, "store"])->name('archives-store')->middleware('auth');
Route::get('archivesboard/edit/{id}', [ArchivesController::class, "edit"])->name('archives-edit')->middleware('auth');
Route::put('archivesboard/update/{id}', [ArchivesController::class, "update"])->name('archives-update')->middleware('auth');
Route::delete('archivesboard/{id}', [ArchivesController::class, "destroy"])->name('archives-delete')->middleware('auth');
Route::get('archivesboard/download/{id}', [ArchivesController::class, "download"])->name('archives-download')->middleware('auth');
Route::get('archivesboard/view/{id}', [ArchivesController::class, 'viewPDF'])->name('archives-view')->middleware('auth');
// authentication 
Route::get('register', [AuthController::class, "index"])->name("register")->middleware('guest');
Route::post('register/store', [AuthController::class, "store"])->name("register-store");
Route::get('/', [AuthController::class, "login"])->name("login")->middleware('guest');
Route::get('login/show', [AuthController::class, "login_fetch"])->name("login-show");
Route::get('logout', [AuthController::class, "logout"])->name("logout");


Route::get('archives/{filename}', function ($filename) {
    $path = storage_path('app/public/archives/' . $filename);

    if (file_exists($path)) {
        return response()->file($path);
    }

    return abort(404);
});

Route::get('/templates/{filename}', function ($filename) {
    $path = storage_path('app/public/templates/' . $filename);

    if (file_exists($path)) {
        return response()->file($path);
    }

    abort(404);
});


// blog 
Route::get('blog', [BlogController::class, 'index'])->name('blog-home');
Route::get('blog/create', [BlogController::class, "create"])->name("blog-create")->middleware('auth');
Route::post('blog/store', [BlogController::class, "store"])->name('blog-store')->middleware('auth');
Route::put('blog/edit/{id}', [BlogController::class, "edit"])->name('blog-edit')->middleware('auth');
Route::put('blog/update/{id}', [BlogController::class, "update"])->name('blog-update')->middleware('auth');
Route::delete('blog/{id}', [BlogController::class, "destroy"])->name('blog-delete')->middleware('auth');

// conference categories
Route::get('conference_categories', [Conference_CategoriesController::class, 'index'])->name('conference_categories-home');
Route::get('conference_categories/create', [Conference_CategoriesController::class, "create"])->name("conference_categories-create")->middleware('auth');
Route::post('conference_categories/store', [Conference_CategoriesController::class, "store"])->name('conference_categories-store')->middleware('auth');
Route::get('conference_categories/edit/{id}', [Conference_CategoriesController::class, "edit"])->name('conference_categories-edit')->middleware('auth');
Route::post('conference_categories/update/{id}', [Conference_CategoriesController::class, "update"])->name('conference_categories-update')->middleware('auth');
Route::get('conference_categories/{id}', [Conference_CategoriesController::class, "destroy"])->name('conference_categories-delete')->middleware('auth');

// conference 
Route::get('conference', [ConferenceController::class, 'index'])->name('conference-home')->middleware('auth');
Route::get('conference/create', [ConferenceController::class, "create"])->name("conference-create")->middleware('auth');
Route::post('conference/store', [ConferenceController::class, "store"])->name('conference-store')->middleware('auth');
Route::get('conference/edit/{id}', [ConferenceController::class, "edit"])->name('conference-edit')->middleware('auth');
Route::post('conference/update/{id}', [ConferenceController::class, "update"])->name('conference-update')->middleware('auth');
Route::get('conference/{id}', [ConferenceController::class, "destroy"])->name('conference-delete')->middleware('auth');

// dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard-home')->middleware('auth');

