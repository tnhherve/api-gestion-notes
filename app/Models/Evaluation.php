<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_evaluation_id',
        'cours_id',
        'titre',
        'note',
        'date_evaluation'
        'ponderation'
    ];
}
