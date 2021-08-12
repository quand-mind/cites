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
use Illuminate\Support\Facades\Log;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
    
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\MessageBag;


class AuthController extends Controller
{

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if ($request->validate(
            [
                // Proveedor
                'email' => 'required',
            ]
        )) {
            try{
                $credentials = $request->only(["email","password"]);
                if ($token = $this->guard()->attempt($credentials)) {
                    return $this->sendLoginResponse($request, $token);
                }
            } catch (\Exception $err){
                return response(json_encode($err), 500);
            }
        }
        return $this->sendFailedLoginResponse($request);
        //$this->incrementLoginAttempts($request);
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        //$this->clearLoginAttempts($request);
        Log::info('El solicitante '.$this->guard()->user()->username.' a ingresado al sistema desde la siguente direccion '. $_SERVER['REMOTE_ADDR']);
        return $this->authenticated($request, $this->guard()->user(), $token);
    }

    protected function authenticated(Request $request, $user, $token)
    {
        setcookie("jwt_token", $token);
        return redirect('solicitante/permissions');
        return response()->json([
            'token' => $token,
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        Log::error('Fallo de autentificacion desde la siguente direccion '. $_SERVER['REMOTE_ADDR'] );
        $errors= "las credenciales no concuerdan con nuestros datos";
        //return response()->view('auth.permissions_login', compact('errors'));
        return Redirect::back()->with('msg','Verifique sus datos');
        return response()->json(['message' => "not found",], 401);
    }

    public function user()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        Log::info('El solicitante '.$this->guard()->user()->username.' a salido del sistema desde la siguente direccion '. $_SERVER['REMOTE_ADDR']);
        $this->guard()->logout();

        return redirect('/loginPermissions');
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
