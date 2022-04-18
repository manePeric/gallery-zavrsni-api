<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(["email", "password"]);

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json(
                [
                    "message" => "Invalid credentials",
                ],
                401
            );
        }

        return response()->json([
            "token" => $token,
            "user" => Auth::user(),
        ]);
    }

    public function getMyGallery()
    {
        $activeUser = Auth::user();
        return response()->json($activeUser);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);

        $token = Auth::login($user);

        return response()->json([
            "token" => $token,
            "user" => $user,
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }
}