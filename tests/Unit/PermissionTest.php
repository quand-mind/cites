<?php

namespace Tests\Unit;

use App\Models\Formalitie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Client; 
use App\Models\User;
use Assortment;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // use Assortment;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $password = 'usuario123';

        // $user = User::factory()->count(1)->create([
        //     'nationality' => 'Venezolano'
        // ]);
        
        $user = new User();
        $user->name = 'Usuario 11';
        $user->nationality = 'Venezolano';
        $user->dni = '28963456';
        $user->domicile = 'Caracas';
        $user->address = 'Av urdaneta edificio dorsay';
        $user->fax = '2737867483';
        $user->save();

        $client = new Client();
        $client->email = 'usuario@gmail.com';
        $client->password = bcrypt($password);
        $client->username = 'usuario_11';
        $client->role = 'natural';
        $client->user_id = $user->id;
        $client->save();

        $response = $this->post(
            '/solictante/loginClient',
            [
                'client' => $client->email,
                'password' => $password,
            ]
        );

        $response->assertRedirect('solicitante/permissions/list');
        $this->assertAuthenticatedAs($client);
    }
}
