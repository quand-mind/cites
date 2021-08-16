<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use Illuminate\Http\Request;


/**
 * Manage Certificate export PDF files
 */

class GenerateCertificate extends Controller
{
    /**
     * Creates PDF of permit
     *
     * @param Integer $id : Permit id
     * 
     * @return PDF
     */
    public function create($id)
    {
        $permit = Permit::find($id);
        return response($permit);
    }
}
