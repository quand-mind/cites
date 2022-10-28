<?php

namespace App\Exports;

use App\Models\Permit;
use App\Models\PermitType;
use App\Models\Specie;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Faker\Factory as Faker;

class FormalitiesExport implements FromView
{
    
    public function view(): View
    {
        $permitTypes = PermitType::all();
        $label = 'Gráfica de los Tipos de Permiso';
        $title = 'Estadisticas por Tipo de Permiso';
        $values = [];
        $backgrounds = [];
        $labels = [];
        foreach ($permitTypes as $permitType) {
            $faker = Faker::create();
            $permitOptionsHexaColor = $faker->hexcolor();
            $permitOptionsId = $permitType->id;
            $permitOptionsName = $permitType->name;
            $permits = Permit::where("permit_type_id", '=', $permitOptionsId)->get();
            $permitOptionsCount = count($permits);
            array_push($values, ($permitOptionsCount));
            array_push($backgrounds, ($permitOptionsHexaColor));
            array_push($labels, ($permitOptionsName));
        } 
        return view('excelTest', ['labels' => $labels, 'data' => $values]);
    }
}    
