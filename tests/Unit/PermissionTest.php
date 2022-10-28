<?php

namespace Tests\Unit;

use App\Models\Formalitie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Client;
use App\Models\Official;
use App\Models\Permit;
use App\Models\Specie;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use Assortment;
use stdClass;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use WithFaker;

    // use Assortment;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_clientData()
    {
        $id = 1;
        $client = Client::where(['id' => $id])->get()->first();

        $user_id = 2;
        $user = User::where(['id' => $user_id])->get()->first();
        $clientData = Client::with('user')->where(['id' => $user->id])->get()->first();
        $formalities = Formalitie::where(['client_id' => $clientData->id])->with(['permits.requeriments', 'permits.permit_type', 'permits.species', 'client.user'])->orderBy('created_at','DESC')->paginate(5);
        $view = 'permissions.permissions';

        $response = $this->actingAs($client, 'api')->get('/solicitante/permissions');
        $response->assertViewIs($view, ['formalities' => $formalities, 'clientData' => $clientData]);
        $response->assertViewHasAll(['formalities' => $formalities, 'clientData' => $clientData]);


    }

    public function test_storePermit()
    {
        $permit_type_id = 1;
        $personals = [];
        $permit = new stdClass();
        $permit->country = new stdClass();
        $permit->country->name = 'Perú';
        $permit->country->code = 'Perú';
        $permit->transportation_way = 'Avión';
        $permit->shipment_port = 'Maiquetía';
        $permit->landing_port = 'Lima Airport';
        $permit->destiny = 'Lima';
        $permit->purpose = 'Prueba de especies';
        $permit->consigned_to = 'José Peréz';
        $permit->destiny_place = 'Zoológico de Lima';
        $permit->departure_place = 'El Pinar';

        $species = [];
        $specie = new stdClass();
        $specie->name_common = 'Cattleya lobata';
        $specie->origin = 'W';
        $specie->description = 'descripción';
        $specie->qty = '12';
        $specie->operation_number = null;
        $specie->old_reexport_date = null;
        $specie->warrant_number = null;
        $specie->origin_country = 'Ecuador';
        $specie->origin_country = null;
        array_push($species, $specie);
        // dd($species);

        $personals = json_encode($personals);
        $species = ($species);
        $permit = json_encode($permit);
        $species = json_encode($species);
        
        $id = 1;
        $client = Client::where(['id' => $id])->get()->first();

        $response = $this->actingAs($client, 'api')->post('/solicitante/permissions/list/createPermit', ['permit_type_id' => $permit_type_id, 'personals' => $personals, 'permit' => $permit, 'client_id' => $client->id, 'species' => $species]);
        dd($response);
        $message = 'Se ha solicitado el permiso, dirijase a la oficina del MINEC para entregar los recaudos.';
        $response->assertOk();


    }

    public function test_requestPermit() 
    {
        $id = 1;
        $idPermit = 2;
        $client = Client::where(['id' => $id])->get()->first();
        $id = 1;
        $response = $this->actingAs($client, 'api')->post('/solicitante/permissions/requestPermit/' . $idPermit);
        // dd($response);
        $message = 'Solicitud de Permiso finalizada';
        $permit = Permit::find($idPermit);
        $response->assertSeeText($message);

    }
    
    public function test_storeFile() 
    {
        $file = UploadedFile::fake()->create('test.pdf');

        // dd($file);
        $index = 1;

        $requeriment = new stdClass();
        $requeriment->updated_at = null;
        $requeriment->created_at = null;
        $requeriment->id = 5;
        $requeriment->name = 'Autorización para la instalación y funcionamiento de zoocriaderos con fines comerciales, emitida por el MINEC (Copia Simple).';
        $requeriment->short_name = 'autorizacion_zoocriaderos';
        $requeriment->type = 'web';
        $requeriment->pivot = new stdClass();
        $requeriment->pivot->permit_id = 1;
        $requeriment->pivot->file_url = null;
        $requeriment->pivot->is_valid = null;

        
        $id = 1;
        $client = Client::where(['id' => $id])->get()->first();
        // dd($client);
        
        $client_id = json_encode($client->id);
        $permit = Permit::find($requeriment->pivot->permit_id);
        $formalitie = Formalitie::find($permit->formalitie_id);
        // dd($permit);

        $requerimentEncoded = json_encode($requeriment);
        $indexEncoded = json_encode($index);
        
        $response = $this->actingAs($client, 'api')->post('/solicitante/permissions/uploadFile/', ['file' => $file,'requeriment' => $requerimentEncoded,'index' => $indexEncoded,'client_id' => $client_id]);
        // dd($response);
        $nameFile = $requeriment->short_name . "_file_".time().".".$file->guessExtension();

        $message = 'files/requeriments/'. $client->username . '/' . $formalitie->request_formalitie_no . '/'.$permit->request_permit_no . '/' . $nameFile;

        $response->assertSeeText($message);
        
        $responseView = $this->get($response->getContent(), ['file' => $file,'requeriment' => $requeriment,'index' => $index,'client_id' => $client_id]);

        $responseView->assertOk();

    }

    public function test_checkPermit() 
    {
        $id = 1;
        $idPermit = 2;
        $official = Official::where(['id' => $id])->get()->first();
        $permit = Permit::find($idPermit);
        $indexRequeriment = 5;
        $requeriment = $permit->requeriments[$indexRequeriment];
        $requerimentValid = $requeriment->pivot->is_valid;
        // dd($requerimentValid);

        $requerimentEncoded = json_encode($requeriment);
        $permitEncoded = json_encode($permit);
        
        $response = $this->actingAs($official, 'web')->post('/dashboard/permissions/check/' . $idPermit, ['requeriment' => $requerimentEncoded, 'permit' => $permit, 'index' => $indexRequeriment]);
        $message = 'Estatus del Recaudo Actualizado.';
        
        $permitEdited = Permit::find($idPermit);
        $requerimentEdited = $permitEdited->requeriments[$indexRequeriment];
        $requerimentEditedValid = $requerimentEdited->pivot->is_valid;
        
        if ($requerimentEditedValid !== $requerimentValid) {
            $response->assertSeeText($message);
        }
    }

    public function test_validPermit() 
    {
        $id = 1;
        
        $idPermit = 2;
        $official = Official::where(['id' => $id])->get()->first();
        $permit = Permit::find($idPermit);
        $formalitie = Formalitie::find($permit->formalitie_id);
        $sistra = '2346654';
        
        $permitsEncoded = json_encode($formalitie->permits);
        
        $response = $this->actingAs($official, 'web')->post('/dashboard/permissions/validPermit/' . $formalitie->id, ['official_id' => $official->id, 'sistra' => $sistra, 'permits' => $permitsEncoded]);
        // dd($response);
        $message = 'Estatus del Trámite y los Permisos Actualizado.';
        
        $permitEdited = Permit::find($idPermit);
        $formalitieEdited = Formalitie::find($permitEdited->formalitie_id);
        
        if ($permitEdited->status == 'valid' && $formalitieEdited->status === 'valid') {
            $response->assertSeeText($message);
        }
    }

    public function test_registerSpecie() 
    {
        $id = 1;
        
        $specie = new stdClass();
        $specie->name_scientific = 'Cattleya lobata';
        $specie->name_common = 'Lelia-da-gávea';
        $specie->type = 'Animalia';
        $specie->description = 'descripción';
        $specie->appendix = 'Apéndice I';
        $specie->class = 'No posee clase';
        $specie->features = 'caracteristicas';
        $specie->geographic_distribution = 'Amazonas';
        $specie->family = 'Ecuador';
        $specie->search_id = 5105;

        $femaleNewPhoto = UploadedFile::fake()->image('female.jpg');
        $maleNewPhoto = UploadedFile::fake()->image('male.jpg');
        $specieEncoded = json_encode($specie);
        $checkSpecie = Specie::where(['name_scientific' => $specie->name_scientific])->get()->first();
        // dd($checkSpecie);

        $official = Official::where(['id' => $id])->get()->first();
        // dd($formalitie->collected_time);
        
        $response = $this->actingAs($official, 'web')->post('/dashboard/species/registerSpecie', ['specie' => $specieEncoded, 'male_img' => $maleNewPhoto, 'female_img' => $femaleNewPhoto]);
        // dd($response);
        $message = 'Especie Añadida correctamente';
        
        
        $specieCreated = Specie::where(['name_scientific' => $specie->name_scientific])->get()->first();
        
        if ($checkSpecie) {
            $response->assertSeeText($messageCreated);
        } else if ($specieCreated) {
            $response->assertSeeText($message);
        }
    }

    public function test_editSpecie() 
    {
        $id = 1;
        
        $specie = new stdClass();
        $specie->name_scientific = 'Cattleya lobata';
        $specie->name_common = 'Lelia-da-gávea';
        $specie->type = 'Animalia';
        $specie->description = 'descripción nueva ';
        $specie->appendix = 'Apéndice I';
        $specie->class = 'No posee clase';
        $specie->features = 'nuevas caracteristicas';
        $specie->geographic_distribution = 'Amazonas';
        $specie->family = 'Familia de Prueba';
        $specie->search_id = 5105;

        $femaleNewPhoto = UploadedFile::fake()->image('female.jpg');
        $maleNewPhoto = UploadedFile::fake()->image('male.jpg');
        $specieEncoded = json_encode($specie);
        $checkSpecie = Specie::where(['name_scientific' => $specie->name_scientific])->get()->first();
        // dd($checkSpecie);

        
        $official = Official::where(['id' => $id])->get()->first(); 
        // dd($formalitie->collected_time);

        $message = 'Especie Añadida correctamente';
        $messageEdited = 'Especie Editada correctamente';
        
        if ($checkSpecie) {
            $createSpecieResponse = $this->actingAs($official, 'web')->post('/dashboard/species/registerSpecie', ['specie' => $specieEncoded, 'male_img' => $maleNewPhoto, 'female_img' => $femaleNewPhoto]);
            $specieCreated = Specie::where(['name_scientific' => $specie->name_scientific])->get()->first();
            if ($specieCreated) {
                $response = $this->actingAs($official, 'web')->post('/dashboard/species/editSpecie', ['specie' => $specieEncoded, 'male_img' => $maleNewPhoto, 'female_img' => $femaleNewPhoto]);
                // dd($response);
                
                $specieEdited = Specie::where(['name_scientific' => $specie->name_scientific])->get()->first();
                
                if ($specieEdited) {
                    $response->assertSeeText($messageEdited);
                }
            }
        }
        
    }
}