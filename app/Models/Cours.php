<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id', 
        'nom_cours', 
        'seuil_reussite' 
    ];

    public function evaluations()
    {
        return $this->hasMany('App\Models\Evaluation');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function typeEvaluations()
    {
        return $this->belongsToMany('App\Models\TypeEvaluation', 'evaluations','cours_id','type_evaluation_id');
    }
}
