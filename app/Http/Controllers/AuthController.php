<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //Method to register a user
    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

        if(Hash::check($request->password, $user->password)){
            return response()->json([
                'user' => $user,
                'token' => $user->createToken(time())->plainTextToken
            ]);
        }
    }

    public function dashboard(){
        return response()->json([
            'success' => 'You are in authentified'
        ]);
    }
}
