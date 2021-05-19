<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cours_id',
        'titre',
        'note',
        'date_evaluation',
        'ponderation',
        'type_evaluation'
    ];
}
