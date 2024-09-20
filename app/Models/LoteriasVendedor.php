<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LoteriasVendedor extends Model
{
    use HasFactory;
    protected $table = 'l_vendedor_loterias';
    protected $primaryKey = 'idregistro';
    public $timestamps = false;
    public $fillable = ["idvendedor","idloteria","cupo","minutos"];
}
?>