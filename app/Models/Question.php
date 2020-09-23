<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'answer', 'is_faq', 'asked_by'
    ];

    public function answeredBy()
    {
        return $this->belongsTo('App\Models\User', 'answered_by');
    }
}
