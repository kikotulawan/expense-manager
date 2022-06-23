<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:100',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed',
            'role_id'   => 'required'
        ]);
 
        if ($validator->fails()) 
        {
            return response()->json(['error_message' => $validator->errors()]);
        }
        
        if ($validator->passes()) 
        {
            $user   = User::create($validator->validate());
            $token  = $user->createToken('API Token')->accessToken;
            return response()->json([ 
                'user'              => $user, 
                'token'             => $token, 
                'success_message'   => 'User created successfully'
            ], 200);
        }
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => 'email|required',
            'password'  => 'required'
        ]);

        if (!auth()->attempt($data)) 
        {
            return response()->json(['error_message' => 'Incorrect Details. Please try again'], 401);
        }

        $token  = auth()->user()->createToken('API Token')->accessToken;
        $user   = auth()->user();
        $role   = auth()->user()->role->role;

        return response()->json([
            'user'              => $user, 
            'role'              => $role, 
            'token'             => $token, 
            'success_message'   => 'Login Successfully'
        ], 200);
    }
}
