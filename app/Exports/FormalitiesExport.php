<?php

namespace App\Exports;

use App\Models\Formalitie;
use App\Models\Permit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class FormalitiesExport implements FromView
{
    
    public function view(): View
    {
        $permitStatus = Permit::get();
        $prelabels = [];
        foreach ($permitStatus as $permitStatu) {
            $prelabels[]= $permitStatu->status;
        }
        $secondlabels = array_unique($prelabels);
        
        $labels = [];
        $data = [];
        foreach ($secondlabels  as $secondlabel) {
            $labels[]=$secondlabel;
        }
        foreach ($labels as $label) {
            $data[] = Permit::where( 'status', '=', $label)->count();
        }
        return view('excelTest', ['labels' => $labels, 'data' => $data]);
    }
}    
