<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteriasOpcion extends Model
{
    use HasFactory;
    protected $table = 'l_loteria_opciones';
    protected $primaryKey = 'idopcion';
    public $timestamps = false;
}
