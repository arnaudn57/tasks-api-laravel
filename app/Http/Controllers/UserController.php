<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    //Methode d'inscription
    public function inscription(Request $request){
        $user_data = $request->validate(
            [
                'name' => 'required|string|min:2|max:255',
                'email' => 'required|string|unique:users|email',
                'password' => 'required|string|min:8|max:255',
                'password_confirm' => 'required|string'
            ]
        );

        $user = User::create([
            'name' => $user_data['name'],
            'email' => $user_data['email'],
            'password' => bcrypt($user_data['password'])
        ]);

        return response($user, 201);
    }


    //Methode de connexion
    public function connexion(Request $request){
        $user_data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $user_data['email'])->first();
        if(!$user || !Hash::check($user_data['password'], $user->password)){
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('CLE_API')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
