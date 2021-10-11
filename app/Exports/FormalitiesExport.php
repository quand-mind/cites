<?php

namespace App\Exports;

use App\Models\Formalitie;
use Maatwebsite\Excel\Concerns\FromCollection;

class FormalitiesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Formalitie::all();
    }
}
