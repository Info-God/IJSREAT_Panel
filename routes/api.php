<?php

use App\Http\Controllers\api\ArchiveAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\AuthendicationAPIController;
use App\Http\Controllers\api\BlogAPIController;
use App\Http\Controllers\api\Conference_categoriesAPIController;
use App\Http\Controllers\api\ConferenceAPIController;
use App\Http\Controllers\api\EditorialController;
use App\Http\Controllers\api\IndexAPIController;
use App\Http\Controllers\IndexController;

use function Laravel\Prompts\search;

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

Route::get('/test', function () {
    die('Test route works!');
});


Route::post('/archiveList', [ArchiveAPIController::class, 'archiveList']);
Route::post('/indexfetch', [IndexAPIController::class, 'indexFetch']);

Route::post('/archiveYearListing', [ArchiveAPIController::class, 'archiveUnique']);
Route::post('/archivePaperListing', [ArchiveAPIController::class, 'archiveFetch']);
Route::post('/archivePaper', [ArchiveAPIController::class, 'archiveGet']);
Route::post('/editorialBoard', [EditorialController::class, 'editorialFetch']);

Route::post('/blogFetch', [BlogAPIController::class, 'blogFetch']);

Route::post('/blogDetails', [BlogAPIController::class, 'blogDetails']);

Route::post('/conferenceCategoriesFetch', [Conference_categoriesAPIController::class, 'conferenceCategoriesFetch']);
Route::post('/conferenceFetch', [ConferenceAPIController::class, 'conferenceFetch']);
