<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
  

    /*public function login_admin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials))
        { 
            // Si los datos son correctos le envias a la vista, como lo tenias anteriormente , te funcionaba pero lo estabas enviando al formulario de login nuevamente .
            //return redirect('/dashboard');
            return response()->json('haz iniciado sesion pa');
        } 
        // en casi de que los datos esten mal , lo envias de regreso con los siguientes errores.
        //return Redirect::back()->with('login_error',1)->withInput();
        return response()->json('tienes un error');
    }*/

    public function redirectTo(){

        // User role
        $role = Auth::user()->role;

        // Check user role
        switch ($role) {
            case 'admin':
            case 'superuser':
            case 'writer':
                return '/dashboard';
                break;
            // case 'writer':
            //         return '/projects';
            //     break;
            default:
                return '/';
                break;
        }
    }
}
