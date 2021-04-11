<?php

namespace App\Models;
// use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animes extends Model
{
    use HasFactory;
    protected $table = 'animes';
    // POUR PAS AVOIR CETTE ERREUR : SQLSTATE[42S22]
    public $timestamps = false;
}
