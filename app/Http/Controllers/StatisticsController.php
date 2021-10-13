<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\PermitType;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class StatisticsController extends Controller
{
    public function showPermitTypeStatistics()
    {
        $permitTypes = PermitType::all();
        $values = [];
        $backgrounds = [];
        $labels = [];
        // $permit = [];
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
        return $values;
        return view('panel.dashboard.permissions.statistics', compact('values', 'backgrounds', 'labels'));
    }
}
    