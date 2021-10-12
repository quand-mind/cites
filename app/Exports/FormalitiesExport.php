<?php

namespace App\Exports;

use App\Models\Formalitie;
use App\Models\Permit;
use Maatwebsite\Excel\Concerns\FromCollection;

class FormalitiesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
    }
}
