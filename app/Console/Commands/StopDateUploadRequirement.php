<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;
use App\Models\Permit;
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
        $permits = Permit::where("status", "=", "requested")->get(); 

        foreach ($permits as $permit) {
            //array_push($array, $permit->id);
            
            if ($permit->collected_time >= Carbon::now()->toDateString()) {
                $changeStatusPermit = Permit::find($permit->id);
                $changeStatusPermit->status = "nulled";
                $changeStatusPermit->save();

                $formalities = Permit::join('formalities', 'formalities.id', '=', 'formalitie_id')
                ->join('clients', 'clients.id', '=', 'client_id' )
                ->where('permits.id', '=', $permit->id )->get();

                foreach ($formalities as $formalitie) {
                    $mail = new DateToUploadTheRequirementsWasExceeded;
                    Mail::to($formalitie->email)->send($mail);
                }
            }
        }
        Log::info('Se han combrobado la fecha limite para cargar los requerimientos de los permisos');
    }
}
