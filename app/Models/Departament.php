<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'acronym'
    ];
    public function permit_types()
    {
        return $this->hasMany(PermitType::class);
    }
}
