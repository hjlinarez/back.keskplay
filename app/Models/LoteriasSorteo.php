<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteriasSorteo extends Model
{
    use HasFactory;
    protected $table = 'l_loteria_sorteos';
    protected $primaryKey = 'idsorteo';
    public $timestamps = false;
    
}
