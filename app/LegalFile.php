<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalFile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'path'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'legal_files';

    /**
     * Generates the file path
     *
     * @return void
     */
    public function setFilePath()
    {
        $this->path = '/files/'. $this->name;
    }
}
