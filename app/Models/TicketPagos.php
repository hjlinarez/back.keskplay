<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPagos extends Model
{
    use HasFactory;
    protected $table = 'l_ticket_pagos';
    protected $primaryKey = 'idregistro';
    public $timestamps = false;
}
