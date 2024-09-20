<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $table        = 'cha_banca_vendedores';
    protected $primaryKey   = 'idvendedor';
    public $timestamps = false;
}
