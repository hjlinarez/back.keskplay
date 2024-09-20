<?php

namespace App\Http\Livewire\Vendedor;

use Livewire\Component;
use App\Models\Paises;
use App\Models\Ciudades;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditVendedorController extends Component
{
    public $paises = array();    
    public $idvendedor;
    public $ciudades;
    public $idpais; // pais donde esta el vendedor
    public $post;
    protected $rules = [                                                
                        'post.nombre_vendedor'=> 'required',
                        'post.email_vendedor'=> 'required',
                        'post.idciudad'=> 'required',
                        'post.direccion_vendedor'=> 'required',
                        'post.telefono_vendedor'=> 'required',
                        'post.porc_animalitos'=> 'required'
                    ];
    public function mount(Vendedor $post)
    {
        //$this->vendedor = Vendedor::where("idvendedor","=", $idvendedor)->first();        
        $this->post = $post;
        $this->idpais = Ciudades::where("idciudad","=", $this->post->idciudad)->first()->idpais;
        $this->ciudades = Ciudades::where("idpais","=",$this->idpais)->get();        
        $this->idvendedor = $this->post->idvendedor;
        $this->paises = Paises::All();
    }

    public function render()
    {
        return view('livewire.vendedor.edit-vendedor-controller');
    }


}
