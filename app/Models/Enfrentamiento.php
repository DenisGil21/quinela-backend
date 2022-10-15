<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enfrentamiento extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function equipos(){
        return $this->belongsToMany(Equipo::class)->withPivot('goles');
    }

    public function apuestas(){
        return $this->hasMany(Apuesta::class);
    }
}
