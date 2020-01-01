<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
        //
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
            'photo' =>  'nullable|mimes:jpeg,jpg,png|image|max:1024',
            'role' => 'in:admin,superuser,client,writer'
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
        //
    }

    public function changeActiveState (Request $request, $id) {
        if ($request->validate([
            'is_active' => 'boolean'
        ])) {
            $user = User::find($id);
            $user->is_active = $request->input('is_active');
            $user->save();
            return response('Usuario actualizado', 200);
        }

        return response('Error actualizando estado del usuario', 500);
    }
}
