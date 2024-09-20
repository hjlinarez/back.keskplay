<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    use HasFactory;
    protected $table = "cha_banca_operador";
    protected $primaryKey = 'idoperador';
    public $timestamps = false;
}
