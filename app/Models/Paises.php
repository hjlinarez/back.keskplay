<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Paises extends Model
{
    use HasFactory;
    protected $table = 'cha_pais';
    protected $primaryKey = 'idpais';
    public $timestamps = false;
}
?>