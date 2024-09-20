<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalitosTicketJugadas extends Model
{
    use HasFactory;
    public $table = 'l_ticket_jugadas';
    public $primaryKey = 'idjugada';
    public $timestamps = false;
}
