<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Permit;
use App\Models\PermitType;
use App\Models\Specie;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GraphicsStatistics;
use App\Exports\AnnualExport;
// use App\Exports\SpeciesStatistics;
// use App\Exports\PlantaeStatistics;
// use App\Exports\AnimaliaStatistics;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;
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
    
    public function selectSpecies(Request $request)
    {
        $speciesIds= [];
        $species = json_decode($request->input('species'));
        // return $species;
        foreach ($species as $specie) {
            array_push($speciesIds, $specie->id);
        }
        $data = $this->getSpecies($speciesIds);
        $data->species = $species;
        return $data;
    }

    public function showSpeciesStatistics(Request $request)
    {

        $title = 'Cantidad de Permisos por las fechas indicadas';
        $species = Specie::get()->take(1);
        $all_species = Specie::all();
        // return $allSpecies;
        $speciesIds = [];
        foreach ($species as $specie) {
            array_push($speciesIds, $specie->id);
        }
        // return $speciesIds;
        
        $data = $this->getSpecies($speciesIds);
        // return $data;
        $datasets = $data->datasets;
        $labels = $data->labels;
        
        return view('panel.dashboard.permissions.bar', compact('datasets', 'labels', 'title', 'species', 'all_species'));

    }

    public function showAnnualReport()
    {
        return view('panel.dashboard.permissions.annual_report');
    }

    public function getSpecies($speciesIds)
    {
        $species = Specie::findMany($speciesIds);
        $datasets = [];

        $dataset = new stdClass();
        $dataset->label = '# de Especies';
        $dataset->data = [];
        $dataset->backgroundColor = [];

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
            array_push($dataset->data, ($permitOptionsCount));
            array_push($dataset->backgroundColor, ($permitOptionsHexaColor));
            array_push($labels, ($permitOptionsName));
        }
        array_push($datasets, $dataset);

        // return $values;
        $data = new stdClass();
        $data->datasets = $datasets;
        $data->labels = $labels;
        return $data;
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

    public function exportToExcel($labels, $datasets, $title)
    {
        return view('excelTest', ['labels' => $labels, 'datasets' => $datasets, 'title' => $title]);
    }
    //Exports to  Excel
    // Esta es la funcion que vamos a usar

    public function exportPermitsData(Request $request)
    {
        // return $request->query('speciesIds');
        $labels = $request->query('labels');
        $title = $request->query('title');
        $documentTitle = $request->query('documentTitle');
        $labels = preg_split("/\,/", $labels);
        $date1 = $labels[0];
        $date2 = $labels[count($labels) - 1];
        
        $data = $this->getPermitCountFromDate($date1, $date2);
        $datasets = $data->datasets;
        $labels = $data->labels;

        // return $datasets[0];

        $documentTitle = $documentTitle . '.xlsx';

        // return $speciesIds;
        return Excel::download(new GraphicsStatistics($labels, $datasets, $title, $documentTitle), $documentTitle);
    }

    public function exportSpeciesData(Request $request)
    {
        // return $request->query('speciesIds');
        $speciesIds = $request->query('speciesIds');
        $title = $request->query('title');
        $documentTitle = $request->query('documentTitle');
        $speciesIds = preg_split("/\,/", $speciesIds);
        
        $data = $this->getSpecies($speciesIds);
        $datasets = $data->datasets;
        $labels = $data->labels;

        // return $datasets[0];

        $documentTitle = $documentTitle . '.xlsx';

        // return $speciesIds;
        return Excel::download(new GraphicsStatistics($labels, $datasets, $title, $documentTitle), $documentTitle);
    }

    public function exportAnnualReport(Request $request)
    {
        $year = $request->query('year');
        $documentTitle = $request->query('documentTitle');
        $title = $request->query('title');
        // return gettype($year);
        
        $datasets = DB::table('species')
                ->join('permit_specie', 'species.id', '=', 'permit_specie.specie_id')
                ->join('permits', 'permit_specie.permit_id', '=', 'permits.id')
                ->join('permit_types', 'permits.permit_type_id', '=', 'permit_types.id')
                ->select(
                    'species.appendix',
                    'species.name_scientific',
                    'permit_specie.description',
                    'permit_specie.qty',
                    'permit_specie.origin_country',
                    'permits.country',
                    'permit_types.type',
                    'permits.request_permit_no',
                    'permits.stamp_number',
                    'permits.purpose',
                    'permit_specie.origin'
                )
                ->whereYear('permits.created_at', $year)
                ->where(['permits.status'=> 'valid'])
                ->orWhere(['permits.status'=> 'printed'])
                ->get();
        // return $datasets;
        // $datasets = [];
        $labels = [
            'Apéndice',
            'Especie',
            'Descripción',
            'Cantidad',
            'País de Origen de la Especie',
            'País de Exportación o Importación',
            'Tipo de Permiso',
            'N° de Permiso',
            'N° de Estampilla',
            'Objeto del Permiso',
            'Origen de los Especímenes',
        ];

        // return $datasets[0];

        $documentTitle = $documentTitle . '.xlsx';

        // return $speciesIds;
        return Excel::download(new AnnualExport($labels, $datasets, $title, $documentTitle), $documentTitle);
    }
}
    
