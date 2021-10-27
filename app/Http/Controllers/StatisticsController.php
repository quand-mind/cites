<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\PermitType;
use App\Models\Specie;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class StatisticsController extends Controller
{
    public function showPermitTypeStatistics()
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
        // return $data;
        return view('panel.dashboard.permissions.doughnut', compact('values', 'backgrounds', 'labels', 'label', 'title'));
    }

    public function showSpeciesStatistics()
    {
        $species = Specie::all();
        $label = 'Gráfica de las distintas de Especies';
        $title = 'Estadísticas por Especie';
        $values = [];
        $backgrounds = [];
        $labels = [];
        foreach ($species as $specie) {
            $faker = Faker::create();
            $permitOptionsHexaColor = $faker->hexcolor();        
            $permitOptionsName = $specie->name_common;
            $permitOptionsCount = count($specie->permits);
            array_push($values, ($permitOptionsCount));
            array_push($backgrounds, ($permitOptionsHexaColor));
            array_push($labels, ($permitOptionsName));
        } 
        // return $species;
        return view('panel.dashboard.permissions.bar', compact('values', 'backgrounds', 'labels', 'label', 'title'));
    }
    public function showPlantaeStatistics()
    {
        $species = Specie::where(['type' => 'Plantae'])->get();
        $label = 'Gráfica de las distintas de Especies de Flora';
        $title = 'Estadísticas por Especies de Flora';
        $values = [];
        $backgrounds = [];
        $labels = [];
        foreach ($species as $specie) {
            $faker = Faker::create();
            $permitOptionsHexaColor = $faker->hexcolor();        
            $permitOptionsName = $specie->name_common;
            $permitOptionsCount = count($specie->permits);
            array_push($values, ($permitOptionsCount));
            array_push($backgrounds, ($permitOptionsHexaColor));
            array_push($labels, ($permitOptionsName));
        } 
        // return $species;
        return view('panel.dashboard.permissions.bar', compact('values', 'backgrounds', 'labels', 'label', 'title'));
    }
    public function showAnimaliaStatistics()
    {
        $species = Specie::where(['type' => 'Animalia'])->get();
        $label = 'Gráfica de las distintas de Especies de Fauna';
        $title = 'Estadísticas por Especies de Fauna';
        $values = [];
        $backgrounds = [];
        $labels = [];
        foreach ($species as $specie) {
            $faker = Faker::create();
            $permitOptionsHexaColor = $faker->hexcolor();        
            $permitOptionsName = $specie->name_common;
            $permitOptionsCount = count($specie->permits);
            array_push($values, ($permitOptionsCount));
            array_push($backgrounds, ($permitOptionsHexaColor));
            array_push($labels, ($permitOptionsName));
        } 
        // return $species[0];
        return view('panel.dashboard.permissions.bar', compact('values', 'backgrounds', 'labels', 'label', 'title'));
    }
}
    
