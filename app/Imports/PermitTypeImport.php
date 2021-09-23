<?php

namespace App\Imports;

use App\Models\PermitType;
use Maatwebsite\Excel\Concerns\ToModel;

class PermitTypeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $cell)
    {
        return new PermitType([
            'name' => $cell[2]
        ]);
    }
}
