<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    try {
      $user = JWTAuth::parseToken()->authenticate();
    } catch (TokenExpiredException $e) {
      return response()->json(['error' => 'token_expired'], 401);
    } catch (TokenBlacklistedException $e) {
      return response()->json(['error' => 'token_invalid'], 401);
    } catch (TokenInvalidException $e) {
      return response()->json(['error' => 'token_blacklisted'], 401);
    } catch (JWTException $e) {
      return response()->json(['error' => 'token_absent'], 401);
    }

    return $next($request);
  }
}
