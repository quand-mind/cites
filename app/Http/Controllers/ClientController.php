<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Institution;
use App\Models\Official;
use App\Models\Phone;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function index() 
    {
        $client = Client::with('user.phones', 'institution.phones')->where(['id' => auth()->user()->id])->get()->first();
        return view('permissions.edit_client', compact('client'));
    }

    public function editClient(Request $request) 
    {
        $client = json_decode($request->input('client'));
        $file = $request->file('file');
        $oldClient = Client::find($client->id);
        $user = User::find($client->user->id);
        $oldClient->user->name = $client->user->name;
        $oldClient->user->dni = $client->user->dni;
        $oldClient->username = $client->username;
        $oldClient->email = $client->email;
        $oldClient->user->nationality = $client->user->nationality;
        $oldClient->user->address = $client->user->address;
        $oldClient->user->fax = $client->user->fax;
        if ($file) {
            $sub_url = 'requeriments/'. $client->username . '/personals';
            $url = $this->createFolder($sub_url);
            $nameFile = "dni_".$client->user->dni."_file_".time().".".$file->guessExtension();
            $url = $request->file('file')->storeAs($url, $nameFile);
            $oldClient->dni_file_url = $url;
        }
        $oldClient->user->save();
        
        foreach ( $client->user->phones as $phone) {
            $findPhone = Phone::find($phone->id);
            $findPhone->number = $phone->number;
            $findPhone->save();
        }
        
        $user->save();

        if ($oldClient->role !== 'natural') {
            $institution = Institution::find($client->institution->id);
            $institution->name = $client->institution->name;
            $institution->institutional_email = $client->institution->institutional_email;
            $institution->rif = $client->institution->rif;
            foreach ( $client->institution->phones as $phone) {
                $findPhone = Phone::find($phone->id);
                $findPhone->number = $phone->number;
                $findPhone->save();
            }
            // $institution->phones[0] = $client->institution->phones[0];
            $institution->save();
        }
        // return $oldClient;
        
        $oldClient->save();
        return response('Usuario actualizado con éxito.', 200);
    }
    public function createFolder($sub_url) 
    {
        $url = '/files/'. $sub_url. '';
        Storage::makeDirectory($url);
        return $url;
    }
}
