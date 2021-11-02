<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\PermitType;
use App\Models\Specie;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class StatisticsController extends Controller
{
    public function index()
    {
        return view('panel.dashboard.permissions.graphics');
    }

    public function showPermitTypeStatistics()
    {
        $permitTypes = PermitType::all();
        $label = 'Gráfica de los Tipos de Permiso';
        $title = 'Estadisticas por Tipo de Permiso';
        $values = [];
        $backgrounds = [];
        $data = [];
        $total = 0;
        $labels = [];
        foreach ($permitTypes as $permitType) {
            $faker = Faker::create();
            $permitOptionsHexaColor = $faker->hexcolor();
            $permitOptionsColor = $faker->safeColorName();
            $permitOptionsId = $permitType->id;
            $permitOptionsName = $permitType->name;
            $permits = Permit::where("permit_type_id", '=', $permitOptionsId)->get();
            $subtitle= "Tipos de Permiso";
            $permitOptionsCount = count($permits);
            $total = $total + $permitOptionsCount;
            array_push($data, (['value' => $permitOptionsCount, 'color' => $permitOptionsHexaColor, 'label' => $permitOptionsName.' ('.$permitOptionsCount.')']));
            array_push($values, ($permitOptionsCount));
            array_push($backgrounds, ($permitOptionsHexaColor));
            array_push($labels, ($permitOptionsName));
        } 
        // return $data;
        return view('panel.dashboard.permissions.doughnut', compact('subtitle', 'label', 'title', 'data', 'total'));
    }

    public function showPermitForDateStatistics()
    {
        $permitTypes = PermitType::all();
        $title = 'Cantidad de Permisos por las fechas indicadas';
        $values = [];
        $backgrounds = [];
        $borders = [];
        $data = [];
        $total = 0;
        $labels = [];
        $faker = Faker::create();
        $permitOptionsHexaColor = $faker->hexcolor();
        foreach ($permitTypes as $permitType) {
            $label = 'Gráfica de Permisos por fecha';
            $permitOptionsColor = $faker->safeColorName();
            $permitOptionsId = $permitType->id;
            $permitOptionsName = $permitType->name;
            $permits = Permit::where("permit_type_id", '=', $permitOptionsId)->get();
            $subtitle= "Tipos de Permiso";
            $permitOptionsCount = count($permits);
            $total = $total + $permitOptionsCount;
            array_push($data, (['value' => $permitOptionsCount, 'color' => $permitOptionsHexaColor, 'label' => $permitOptionsName.' ('.$permitOptionsCount.')']));
            array_push($values, ($permitOptionsCount));
            array_push($borders, ($permitOptionsHexaColor));
            array_push($backgrounds, ($permitOptionsHexaColor));
            array_push($labels, ($permitOptionsName));
        } 
        // return $data;
        return view('panel.dashboard.permissions.line_chart', compact('values', 'backgrounds', 'labels', 'label', 'title', 'borders'));
    }

    public function showSpeciesStatistics()
    {
        $species = Specie::all();
        $label = 'Gráfica de las distintas de Especies';
        $title = 'Estadísticas por Especie';
        $values = [];
        $backgrounds = [];
        $borders = [];
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
    