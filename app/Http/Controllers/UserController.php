<?php

namespace App\Http\Controllers;

use App\Models\Official;
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
        $users = Official::with(['user'])->get();
        return view('panel.dashboard.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response('Todo bien', 200);
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
            'username' => 'required|unique:officials',
            'name' => 'required|string',
            'address' => 'required|string',
            'domicile' => 'required|string',
            'dni' => 'required|string|',
            'email' => 'required|unique:officials|email',
            'is_active' => 'required|boolean',
            'photo' =>  'nullable|sometimes|mimes:jpeg,jpg,png|image|max:1024',
            'role' => 'required|in:admin,writer,funcionario',
            'password' => 'required|confirmed'
        ])) {
            if ($request->hasFile('photo')) {
                // handle user picture
                $valuesUser = $request->except(['photo', 'password', 'password_confirmation', 'username', 'email', 'role']);

                // Save picture
                $path = $request->file('photo')->store('images');
                $path = '/storage/' . $path;

                $valuesUser['photo'] = $path;
            } else {
                $valuesUser = $request->except(['password_confirmation', 'password', 'username', 'email', 'role']);
            }

            try {
                $findedUserWithDni = User::where(['dni' => $request->dni])->get()->first();
                if (!$findedUserWithDni) {
                    $user = User::create($valuesUser);

                    $official = new Official;
                    $official->username = $request->username;
                    $official->email = $request->email;
                    $official->role = $request->role;
                    $official->user_id = $user->id;
                    $official->password = \bcrypt($request->password);
                    $official->save();
                } else {

                    $findedOfficialWithId = Official::where(['user_id' => $findedUserWithDni->id])->get()->first();
                    // return $findedUserWithDni;
    
                    if (!$findedOfficialWithId) {
                        $official = new Official;
                        $official->username = $request->username;
                        $official->email = $request->email;
                        $official->role = $request->role;
                        $official->user_id = $findedUserWithDni->id;
                        $official->password = \bcrypt($request->password);
                        $official->save();
                    } else {
                        return response('Este usuario ya se encuentra registrado en el sistema administrador', 500);
    
                    }
                }

                // $user = User::create($valuesUser);

                // $official = new Official;
                // $official->username = $request->username;
                // $official->email = $request->email;
                // $official->role = $request->role;
                // $official->user_id = $user->id;
                // $official->password = \bcrypt($request->password);
                // $official->save();

                
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
            'dni' => 'string',
            'domicile' => 'string',
            'address' => 'string',
            'is_active' => 'boolean',
            'photo' =>  'nullable|mimes:jpeg,jpg,png|image|max:2048',
            'role' => 'in:admin,writer,funcionario'
        ])) {

            if ($request->hasFile('photo')) {
                // handle user picture
                $valuesUser = $request->except(['photo', 'username', 'email', 'role']);

                // Save picture
                $path = $request->file('photo')->store('images');
                $path = '/storage/' . $path;

                // Delete prev picture if exist

                $valuesUser['photo'] = $path;
            } else {
                $valuesUser = $request->except(['username', 'email', 'role']);
                // $values = $request->all();
            }

            // return $valuesUser;

            $official = Official::where('username', $request->username)->first();
            // return $id;
            if ($official && $official->id != $id) {
                return response('Este nombre de usuario ya existe', 400);
            }
            // return $official;

            $official = Official::where('email', $request->email)->first();
            if ($official && $official->id != $id) {
                return response('Ya existe un usuario con este correo', 400);
            }

            // return $official;

            try {
                $official = Official::find($id);
                // return $official->user_id;

                User::find($official->user_id)->update($valuesUser);

                $official->username = $request->username;
                $official->email = $request->email;
                $official->role = $request->role;
                // $official->user_id = $user->id;
                $official->password = \bcrypt($request->password);
                $official->save();
                
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
            Official::find($id)->delete();
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
                // return $user;
                $user->is_active = $request->input('is_active');
                $user->save();
                return response('Usuario actualizado', 200);
            } catch (Exception $err) {
                return response($err->getMessage(), 500);
            }
        }

    }
}
