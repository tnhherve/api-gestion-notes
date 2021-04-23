<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEvaluation extends Model
{
    use HasFactory;

    protected $fillable = ['nom_type', 'ponderation'];

    public function evaluations()
    {
        return $this->hasMany('App\Models\Evaluation');
    }
}
