<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function apuestas(){
        return $this->belongsToMany(Apuesta::class,'equipo_apuesta')->withPivot('goles');
    }

    public function enfrentamientos(){
        return $this->belongsToMany(Enfrentamiento::class)->withPivot('goles');
    }
}
