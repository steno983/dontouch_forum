<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController
{
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');
    $token = JWTAuth::attempt($credentials);
    try {
      if (!$token) {
        return response()->json(['error' => 'invalid_credentials'], 401);
      }
    } catch (JWTException $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }

    return response()->json(['token' => $token, 'user' => [
      'id' => auth()->id(),
      'name' => auth()->user()->name,
    ]]);
  }
}
