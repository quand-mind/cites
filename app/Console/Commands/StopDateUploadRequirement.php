<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;
use App\Models\Permit;
use App\Models\Formalitie;
use App\Mail\DateToUploadTheRequirementsWasExceeded;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class StopDateUploadRequirement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:fileUploadFinishDate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'tarea que se ejecutara cada 24H para comprobar que no se ha exedido la fecha limeite para cargar los reqerimientos para el permiso';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $formalities= Formalitie::with('client')->where("status", "=", "uploading_requeriments")->get();
        foreach ($formalities as $formalitie) {
            if ($formalitie->collected_time >= Carbon::now()->toDateString()) {
                $formalitie = Formalitie::find($formalitie->id)->first();
                $formalitie->status = "nulled";
                $formalitie->save();
                
                Mail::to('jasve504@gmail.com')->send(new DateToUploadTheRequirementsWasExceeded($formalitie));
                //$formalitie->client->email
            }
        }
        Log::info('Se han combrobado la fecha limite para cargar los recaudos de los permisos');
    }
}
