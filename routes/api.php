<?php
use App\Models\Learner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/learners', function (){
//     return Learner::all();
// });

// Route::post('/learners', function (){
//     return Learner::create([
//         'first_name' => 'Test',
//             'last_name' =>'Test',
//             'email' => 'test@yahoo.com',
//             'password' => 'password',
//             'level' => 'beginner',
//     ]);
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
