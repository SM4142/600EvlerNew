<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class authController extends Controller
{
    public function Register(Request $request){
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password'=>'required|min:5'
            ]);
            $newUser = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            $newUser->createToken('auth_token')->plainTextToken;
            return response()->json([
                'data' => $newUser
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }
    public function Login(Request $request){
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
                'password'=>'required|min:5'
            ]);
            $newUser = User::where('email', $request->input('email'))->first();
            if(!Hash::check($request->input('password'), $newUser->password)){
                return response()->json([
                    'errors' => "Wrong Password"
                ]);
            }
            $newUser->createToken('auth_token')->plainTextToken;
            return response()->json([
                'data' => $newUser
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }
}
