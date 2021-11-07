<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\PermitType;
use App\Models\Specie;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use stdClass;

class StatisticsController extends Controller
{
    public function index()
    {
        return view('panel.dashboard.permissions.graphics');
    }

    public function showPermitTypeStatistics()
    {
        $permitTypes = PermitType::all();
        $title = 'Estadisticas por Tipo de Permiso';
        $label = 'Tipos de Permiso';
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
        return view('panel.dashboard.permissions.doughnut', compact('subtitle', 'label', 'title', 'data', 'total'));
    }

    public function showPermitForDateStatistics()
    {
        $title = 'Cantidad de Permisos por las fechas indicadas';
        $date1 = date('Y-m-d');
        $date2 = $date1;
        $date2Formated = new DateTime($date2);
        $date2Formated = $date2Formated->add(new DateInterval('P10D'));
        $date2 = $date2Formated->format('Y-m-d');
        
        $data = $this->getPermitCountFromDate($date1, $date2);
        $datasets = $data->datasets;
        $labels = $data->labels;
        return view('panel.dashboard.permissions.line_chart', compact('datasets', 'date1', 'date2', 'title', 'labels'));
    }

    public function selectDate(Request $request)
    {
        $date1 = $request->input('date1');
        $date2 = $request->input('date2');
        $data = $this->getPermitCountFromDate($date1, $date2);
        return $data;
    }

    public function getPermitCountFromDate($date1, $date2)
    {
        $permitTypes = PermitType::all();
        $datasets = [];
        $faker = Faker::create();

        $date1Formated = new DateTime($date1);
        $date2Formated = new DateTime($date2);
        $countLabels = 10;

        $actualDate = new DateTime($date1);

        $dates = [];
        $daysDifference = $date1Formated->diff($date2Formated)->format("%r%a");
        if ($daysDifference < $countLabels) {
            $countLabels = $daysDifference;
        }
        $dayBetweenLabel = (int) ($daysDifference / $countLabels);

        array_push($dates, $date1);
        for ($i=0; $i < $countLabels - 1; $i++ ) {
            $actualDate->add(new DateInterval('P'.$dayBetweenLabel.'D')); // P1D means a period of 1 day
            $actualDateFormated = $actualDate->format('Y-m-d');
            array_push($dates, $actualDateFormated);
        }
        array_push($dates, $date2);
        $labels = $dates;
        
        foreach ($permitTypes as $permitType) {
            $permitOptionsHexaColor = $faker->hexcolor();
            $permitOptionsId = $permitType->id;
            $permitOptionsName = $permitType->name;
            
            $dataset = new stdClass();
            $dataset->label = $permitOptionsName;
            $dataset->data = [];
            $dataset->backgroundColor = [];
            $dataset->borderColor = [];
            $dataset->fill = false;
            $dataset->borderWidth = 1;
            $j = 1;
            array_push($dataset->backgroundColor, ($permitOptionsHexaColor));
            array_push($dataset->borderColor, ($permitOptionsHexaColor));
            foreach ( $dates as $date) {
                if ($j <= $countLabels) {
                    $permits = Permit::where(["permit_type_id" => $permitOptionsId])
                       ->whereBetween('created_at', array($date, $dates[$j]))
                       ->get();
                    $permitOptionsCount = count($permits);
                    array_push($dataset->data, ($permitOptionsCount));
                    $j++;
                } else {
                    $permits = Permit::where(["permit_type_id" => $permitOptionsId])
                       ->whereBetween('created_at', array($date, $date))
                       ->get();
                    $permitOptionsCount = count($permits);
                    array_push($dataset->data, ($permitOptionsCount));
                    $j++;
                }
            }
            array_push($datasets, $dataset);
        }
        $data = new stdClass();
        $data->datasets = $datasets;
        $data->labels = $labels;
        return $data;
    }

    public function showSpeciesStatistics()
    {
        $species = Specie::all();
        $label = '# de Especies';
        $title = 'Estadísticas por Especie';
        $values = [];
        $backgrounds = [];
        $borders = [];
        $labels = [];
        foreach ($species as $specie) {
            $faker = Faker::create();
            $permitOptionsHexaColor = $faker->hexcolor();        
            $permitOptionsName = $specie->name_common;
            $permitOptionsCount = 0;
            foreach ($specie->permits as $permit) {
                $qty = $permit->pivot->qty;
                $permitOptionsCount = $permitOptionsCount + $qty;
            }
            array_push($values, ($permitOptionsCount));
            array_push($backgrounds, ($permitOptionsHexaColor));
            array_push($labels, ($permitOptionsName));
        } 
        // return $values;
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
    