<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTGuard;
use Log;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
    
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /*public function login(Request $request)
    {
      $credentials = $request->only('email', 'password');
      try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);  
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json($token);
      //return redirect("permissions/authorizations");
     // return response()->view('permissions.authorizations')->header('Authorization', 'bearer '."$token");
    }*/

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(["email","password"]);
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->sendLoginResponse($request, $token);
        }

        //$this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        //$this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user(), $token);
    }

    protected function authenticated(Request $request, $user, $token)
    {
        setcookie("jwt_token", $token);
        return redirect('api/permissions/authorizations');
        return response()->json([
            'token' => $token,
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json(['message' => "not found",], 401);
    }

    public function user()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        $this->guard()->logout();

        return \redirect('/loginPermissions');
    }


    
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
    */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }

}
