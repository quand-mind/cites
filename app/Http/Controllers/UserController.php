<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


class UserController extends Controller
{

    use SendsPasswordResetEmails;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('panel.dashboard.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate data 
        if ($request->validate([
            'username' => 'required|unique:users|alpha_dash',
            'name' => 'required|string',
            'email' => 'required|unique:users|email',
            'is_active' => 'required|boolean',
            'photo' =>  'nullable|sometimes|mimes:jpeg,jpg,png|image|max:1024',
            'role' => 'required|in:admin,writer,perosna_juridica,persona_natural',
            'password' => 'required|confirmed'
        ])) {
            if ($request->hasFile('photo')) {
                // handle user picture
                $values = $request->except(['photo', 'password_confirmation']);

                // Save picture
                $path = $request->file('photo')->store('images');
                $path = '/storage/' . $path;

                $values['photo'] = $path;
            } else {
                $values = $request->except('password_confirmation');
            }

            try {
                $values['password'] = \bcrypt($values['password']);
                User::create($values);
                return response('Usuario creado', 200);

            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate inputs
        if ($request->validate([
            'username' => 'alpha_dash',
            'name' => 'string',
            'email' => 'email',
            'is_active' => 'boolean',
            'photo' =>  'nullable|mimes:jpeg,jpg,png|image|max:2048',
            'role' => 'in:admin,writer,perosna_juridica,persona_natural'
        ])) {

            if ($request->hasFile('photo')) {
                // handle user picture
                $values = $request->except('photo');

                // Save picture
                $path = $request->file('photo')->store('images');
                $path = '/storage/' . $path;

                // Delete prev picture if exist

                $values['photo'] = $path;
            } else {
                $values = $request->all();
            }

            $user = User::where('username', $request->username)->first();
            if ($user && $user->id != $id) {
                return response('Este nombre de usuario ya existe', 400);
            }

            $user = User::where('email', $request->email)->first();
            if ($user && $user->id != $id) {
                return response('Ya existe un usuario con este correo', 400);
            }

            try {
                User::find($id)->update($values);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }

            return response('Usuario actualizado', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::find($id)->delete();
            return response('Usuario eliminado', 200);
        } catch (Exception $err) {
            return response($err->getMessage(), 500);
        }
    }

    /**
     * Change active status for any user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeActiveState (Request $request, $id) {
        if ($request->validate([
            'is_active' => 'boolean'
        ])) {

            try {
                $user = User::find($id);
                $user->is_active = $request->input('is_active');
                $user->save();
                return response('Usuario actualizado', 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }

    }
}
