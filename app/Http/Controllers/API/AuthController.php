<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Learner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Enums\ServerStatus;
use App\Models\Teacher;
use Illuminate\Validation\Rules\Enum;
//use Laravel\Sanctum\HasApiTokens;


class AuthController extends Controller
{
    //use HasApiTokens;

    //ZA USERA AUTENTIFIKACIJA
    // public function register(Request $request){
    //     $fields = $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|string|unique:users,email',
    //         'password' => 'required|string|confirmed'
    //     ]);

    //     $user = User::create([
    //         'name' => $fields['name'],
    //         'email' => $fields['email'],
    //         'password' => bcrypt($fields['password'])
    //     ]);

    //     $token = $user->createToken('myapptoken')->plainTextToken;

    //     $response = [
    //         'user' => $user,
    //         'token' => $token
    //     ];

    //     return response($response, 201);
    // }

    //za LEARNERa AUTENTIFIKACIJA
    public function register(Request $request){
        $fields = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'level' => 'required|in:Beginner,Intermediate,Advanced'
        ]);

        $learner = Learner::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
           // 'level' => 'required|in:Beginner,Intermediate,Advanced'
           'status' => [new Enum(ServerStatus::class)]
           
        ]);

        $token = $learner->createToken('myapptoken')->plainTextToken;

        $response = [
            'learner' => $learner,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }


    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(

        $learner = Learner::where('email', $fields['email'])->first()

        ){

        if(!$learner || !Hash::check($fields['password'], $learner->password))  {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $tokenL = $learner->createToken('myapptoken')->plainTextToken;

    
        $response = [
                'learner' => $learner,
                'token' => $tokenL
            ];
            return response($response, 201);

            }else{

            if(
            
          
            $teacher = Teacher::where('email', $fields['email'])->first()

            ){

            if(!$teacher || !Hash::check($fields['password'], $teacher->password))  {
                return response([
                    'message' => 'Bad creds'
                ], 401);
            }
    
            $tokenT = $teacher->createToken('myapptoken')->plainTextToken;
    
        
            $response = [
                    'teacher' => $teacher,
                    'token' => $tokenT
                ];
                return response($response, 201);
                }
            }
    }

}
