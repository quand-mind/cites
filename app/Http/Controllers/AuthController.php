<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTGuard;
use Illuminate\Support\Facades\Log;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
    
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        return view('auth.registerClient');
    }

    protected function storeClient(Request $request){
         
        /*$request->validate([
            //model client
            'username' => 'required',
            'email' => 'required|unique:clients',
            'role' => 'required',
            'password' => 'required',
            'name' => 'required',
            'dni' => 'required|unique:users',
            'nationality' => 'required',
            'domicile' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'fax' => 'required',
        ]);*/
        
        $usersData= new User;
        $usersData->name = $request->input('name');
        $usersData->dni = $request->input('dni');
        $usersData->nationality = $request->input('nationality');
        $usersData->domicile = $request->input('domicile');
        $usersData->address = $request->input('address');
        $usersData->phone = $request->input('phone');
        $usersData->mobile = $request->input('mobile');
        //$usersData->fax = $request->input('fax');
        $usersData->save();

        //$users = new User($usersData);
        //$users->save();

                
        $client = new Client();
        $client->username = $request->input('username');
        $client->email = $request->input('email');
        $client->role = $request->input('role');
        $client->password = Hash::make($request->input('password'));
        $client->user_id = $usersData->id;
        $client->save();

        //return 'Client create';
        return $this->login($request);
    }           

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only(["email","password"]);
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->sendLoginResponse($request, $token);
        }
           
        return $this->sendFailedLoginResponse($request);
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
        
        return redirect()->back()->with('errors', 'todo mal');
       //return redirect('/loginPermissions')->withErrors(['las credenciales no concuerdan con nuestra data']);
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
