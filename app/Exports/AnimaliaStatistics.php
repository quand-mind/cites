<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Specie;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class AnimaliaStatistics implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $species = Specie::where(['type' => 'Animalia'])->get();
        $label = 'Gráfica de las distintas de Especies de Fauna';
        $title = 'Estadísticas por Especies de Fauna';
        $values = [];
        // $backgrounds = [];
        $labels = [];
        foreach ($species as $specie) {
            // $faker = Faker::create();
            // $permitOptionsHexaColor = $faker->hexcolor();        
            $permitOptionsName = $specie->name_common;
            $permitOptionsCount = count($specie->permits);
            array_push($values, ($permitOptionsCount));
            array_push($backgrounds, ($permitOptionsHexaColor));
            array_push($labels, ($permitOptionsName));
        }
        return view('excelTest', ['labels' => $labels, 'data' => $values]);
    }
}
