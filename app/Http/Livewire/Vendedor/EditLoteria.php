<?php

namespace App\Http\Livewire\Vendedor;
use Livewire\Component;
use App\Models\LoteriasVendedor;

class EditLoteria extends Component
{
    
    public $datos;

    public $idregistro;
    public $idloteria;

    public $cupo;
    public $minutos;

    public $post;

    protected $rules = [                                                
                        'post.cupo'=> 'required',
                        'post.minutos'=> 'required'
                    ];

    public function mount(LoteriasVendedor $post)
    { 
        $this->post = $post;
        $this->idregistro = $post->idregistro;
        $this->datos = LoteriasVendedor::where('idregistro','=',$post->idregistro)->first();
        
    }

    public function render()
    {
        return view('livewire.vendedor.edit-loteria');
    }


    public function modificar()
    {
        $this->post->save();
        $this->emit('render');

    }
}
