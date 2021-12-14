<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
       $attributes = $request->validate([
           'name' => 'required|string',
           'email' => 'required|string|unique:users,email',
           'password' => 'required|string|confirmed'
       ]);

       $user = User::create([
           'name' => $attributes['name'],
           'email' => $attributes['email'],
           'password' => bcrypt($attributes['password']),
       ]);

       $token = $user->createToken('myapptoken')->plainTextToken;

       $response = [
           'user' => $user,
           'token' => $token
       ];

       return response($response, 201);
    }

    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        //check email
        $user = User::query()->where('email', $attributes['email'])->first();
        if(!$user || ! Hash::check($attributes['password'], $user->password)) {
            return response(['message' => 'user/password is wrong.'], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout()
    {
       auth()->user()->tokens()->delete();

       return response(['message' => 'You are successfully logout.'], 200);
    }
}
