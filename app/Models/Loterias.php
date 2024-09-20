<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loterias extends Model
{
    use HasFactory;
    protected $table = 'l_loteria';
    protected $primaryKey = 'idloteria';
    public $timestamps = false;
}
