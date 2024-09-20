<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalitosTicket extends Model
{
    use HasFactory;

    public $table = 'l_ticket';
    public $primaryKey = 'idticket';
    public $timestamps = false;
}
