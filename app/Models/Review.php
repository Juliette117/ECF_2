<?php

namespace App\Models;
// use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model


{
    use HasFactory;
    protected $table = 'review';
    // POUR PAS AVOIR CETTE ERREUR : SQLSTATE[42S22]
    public $timestamps = false;
}
