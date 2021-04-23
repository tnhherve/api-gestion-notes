<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['nom_section'];

    public function cours()
    {
        return $this->hasMany('App\Models\Cours');
    }
}
