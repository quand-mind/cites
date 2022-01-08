<?php

namespace Tests\Unit;

use App\Models\Formalitie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Client;
use App\Models\Official;
use App\Models\User;
use Faker\Factory as Faker;
use Assortment;
use stdClass;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login()
    {
        $faker = Faker::create();
        
        $user = User::create([
            'name'      => 'Prueba',
            'nationality'=> 'Venezolano',
            'dni'       => 'V-27647273',
            'domicile'  => 'Caracas',
            'address'   => 'Av urdaneta edificio dorsay',
            'fax'       => $faker->tollFreePhoneNumber,
        ]);
        $password = 'prueba123';
        $official = Official::create([
            'email'     => 'prueba@mail.com',
            'password'  => bcrypt($password),
            'username'  => 'prueba',
            'role'      => 'writer',
            'user_id'   => $user->id,
        ]);
        $response = $this->actingAs($official)->get('/login');
        $response->assertRedirect('/dashboard');


    }
    public function test_register()
    {
        $data = new stdClass();
        $data->name = 'Algo';
        $data->dni = 'V-212345433';
        $data->nationality = 'Venezolano';
        $data->address = 'Caracas';
        $data->username = 'algo_name';
        $data->email = 'algo@mail.com';
        $data->password = '123456';
        $data->password_confirm = '123456';
        $data->role = 'natural';
        $data->phone1 = '041276857463';
        $data->phone2 = '041276948463';
        $userData = new stdClass(); 
        $userData->data = $data; 
        $users = [];
        $dataEncode = json_encode($data);

        array_push($users, $userData);
        
        $response = $this->post('/solicitante/registerClient', ['data' => $dataEncode]);
        // dd($response);
        
        $response
        ->assertSee('Usuario Creado Exitósamente');
        // ->assertSessionHas('status', 'Zodra uw account is goedgekeurd ontvangt u een email');
        
        //Remove password and password_confirmation from array
        // array_splice($user,4, 2);
        
        $client = Client::where(['email' => $data->email])->get()->first();
    }
}
