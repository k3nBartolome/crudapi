<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AuthController extends Controller
{
    public function register(Request $request)
    {
      $user = User::create([
        'lname' => $request->lname,
        'fname' => $request->fname,
        'mname' => $request->mname,
        'role_id' => $request->role_id,
        'email' => $request->email,
        'password' => bcrypt($request->password),
      ]);

      $token = auth()->login($user);

      return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
      $input = $request->only('email', 'password');
        $jwt_token = null;
  
        if (!$jwt_token = auth()->attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ]);
        }
  
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'message' => 'goods',
        ]);
    }

    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
      ]);
    }
}

