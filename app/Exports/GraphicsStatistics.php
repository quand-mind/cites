<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Specie;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class GraphicsStatistics implements FromView
{
    public function __construct($labels, $datasets, $title)
    {
        $this->labels = $labels;
        $this->datasets = $datasets;
        $this->title = $title;
    }

    public function view(): View
    {
        return view('excelTest', ['labels' => $this->labels, 'datasets' => $this->datasets, 'title' => $this->title]);
    }
}
