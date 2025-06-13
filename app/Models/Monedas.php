<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monedas extends Model
{
    use HasFactory;
    protected $table = "moneda";
    protected $primaryKey = 'idmoneda';
    protected $casts = [
    'idmoneda' => 'string',
];
    public $timestamps = false;
}
