<?php

use App\Http\Controllers\API\LearnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DictionaryController;
use App\Http\Controllers\API\SentenceController;
use App\Http\Controllers\API\CommentController;


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

// Route::get('/learners', [LearnerController::class, 'index']);
// Route::post('/learners', [LearnerController::class, 'store']);
// Route::get('/learners/{id}', [LearnerController::class, 'show']);
// Route::put('/learners/{id}', [LearnerController::class, 'update']);

//dictionary api
Route::get('/search/{word}', [DictionaryController::class, 'getWord']);

//public
 Route::post('/register', [AuthController::class, 'register']);
 Route::post('/login', [AuthController::class, 'login']);





//protected
// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::resource('/learners', LearnerController::class);
//     Route::get('/learners/search/{name}', [LearnerController::class, 'search']);
//   Route::post('/logout', [AuthController::class, 'logout']);


// });

//protected admin routes
Route::group(['middleware' => ['auth:admin']], function () {
    Route::resource('/learners', LearnerController::class);
    Route::get('/learners/search/{name}', [LearnerController::class, 'search']);
    Route::post('/logoutAdmin', [AuthController::class, 'logout']);

    Route::post('/sentences', [SentenceController::class, 'store']);
    Route::put('/sentences/{id}', [SentenceController::class, 'update']);
    Route::delete('/sentences/{id}', [SentenceController::class, 'destroy']);
    Route::post('/commentsAdmin', [CommentController::class, 'store']);
    Route::delete('/commentsAdmin/{comment}', [CommentController::class, 'destroy']);


});

//protected learner routes
Route::group(['middleware' => ['auth:learners']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
    Route::put('/learnersUpdate/{id}', [LearnerController::class, 'update']);
    Route::delete('/learnersDelete/{id}', [LearnerController::class, 'destroy']);
    Route::get('/Usercomments', [CommentController::class, 'getUserComments']);
    Route::get('/UserLevelSentences', [SentenceController::class, 'UserLevelSentence']);






});


//public routes
Route::get('/sentences', [SentenceController::class, 'index']);
Route::get('/sentences/{sentence}', [SentenceController::class, 'show']);
Route::get('/sentences/search/{name}', [SentenceController::class, 'search']);
Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'show']);


