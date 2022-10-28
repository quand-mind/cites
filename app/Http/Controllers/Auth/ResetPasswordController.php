<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Official;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use JWTAuth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function sendClientResetEmail(Request $request)
    {
        $email = $request->query('email');
        $user = Client::where('email', $email)->get()->first();

        if (!$user) {
            return response('No existe el usuario');
        }

        // Encrypt User
        $token = JWTAuth::fromUser($user);

        Mail::to($email)->send(new ResetPasswordEmail($token));
        return view('auth.passwords.confirm_message');
    }

    public function recoveryClientPassword(Request $request) {
        try {
            $token = $request->query('token');
            // return response($token);
            $jwt = JWTAuth::setToken($token);
            $payload = $jwt->getPayload()->get('sub');

            $user = Client::find($payload);

            if ($user) {
                return view('auth.passwords.reset_password', compact('user', 'token'));
            }
            
            // return response('Usuario no encontrado', 404);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json('El link ha expirado', 500);
    
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    
            return response()->json('Usuario no encontrado', 404);
    
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    
            return response()->json(['token_absent' => $e->getMessage()], 500);
    
        }
    }
    public function resetClientPassword(Request $request)
    {
        $token = $request->input('token');
        $email = $request->input('email');
        $newPassword = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        $user = Client::where('email', $email)->get()->first();
        // return $user->password;
        if ($user) {
            
            if ($newPassword === $password_confirmation ) {
                $user->password = Hash::make($newPassword);
                $user->save();
                return view('auth.passwords.valid_reset');
            } else {
                return Redirect::back()->withErrors(['password', 'Las contraseñas no coinciden.']);
            }
        } else {
            return Redirect::back()->withErrors(['email', 'El usuario no posee ese email.']);
        }
    }

    public function __construct()
    {
        $this->middleware('guest');
    }
}
