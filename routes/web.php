<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\API\AuthController;




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

//==============Admin Route=============================
Route::prefix('admin')->group(function(){
    Route::get('/login', [TeacherController::class, 'loginAdminform'])->name('login_form');
    Route::post('/login/owner', [TeacherController::class, 'login'])->name('admin_login');
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('admin_dashboard')->middleware('admin');
    Route::get('/logout', [TeacherController::class, 'logoutAdmin'])->name('admin_logout')->middleware('admin');



});

Route::get('/sentences', [SentenceController::class, 'index'])->name('index');
Route::get('/sentences/create', [SentenceController::class, 'create'])->name('create_form')->middleware('admin');
Route::post('/sentences/create', [SentenceController::class, 'store'])->name('create')->middleware('admin');
Route::get('/sentences/{id}', [SentenceController::class, 'show']);
Route::get('/sentences/{id}/edit', [SentenceController::class, 'edit'])->middleware('admin');
Route::put('/edit_sentences/{id}', [SentenceController::class, 'update'])->middleware('admin');
Route::delete('/sentences/{id}', [SentenceController::class, 'destroy'])->middleware('admin');

Route::resource('/learners', LearnerController::class);





// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('1welcome');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
