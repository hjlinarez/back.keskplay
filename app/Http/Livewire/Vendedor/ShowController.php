<?php

namespace App\Http\Livewire\Vendedor;
use Livewire\Component;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShowController extends Component
{
    public $titulo;
    public $vendedores;
    public $status = 'TOD';
    public $buscador;


    public $nombre_vendedor;
    public $email_vendedor;
    public $idciudad;
    public $direccion_vendedor;
    public $telefono_vendedor;
    public $usuario;
    public $porc_animalitos;

    protected $listener = ['render'=> 'render'];

    public $mensaje;


    public $post;
    protected $rules = [                                                
                        'post.nombre_vendedor'=> 'required',
                        'post.email_vendedor'=> 'required',
                        'post.idciudad'=> 'required',
                        'post.direccion_vendedor'=> 'required',
                        'post.telefono_vendedor'=> 'required',
                        'post.porc_animalitos'=> 'required'
                    ];


    public function mount()
    {
        $this->titulo = "Vendedores";
        $this->mensaje = "Hola";
    }

    public function render()
    {   
        if ($this->status == 'TOD')
        {
            if (empty($this->buscador))
            {
                $this->vendedores = Vendedor::where("idagente", "=", Auth::user()->idagente)->get();   
            }
            else 
            {
                $this->vendedores = Vendedor::where("idagente", "=", Auth::user()->idagente)
                                            ->where(function($q){
                                                $q->Where("nombre_vendedor","like", '%'.$this->buscador.'%')
                                                ->orWhere("email_vendedor","like", '%'.$this->buscador.'%')
                                                ->orWhere("telefono_vendedor","like", '%'.$this->buscador.'%')
                                                ->orWhere("direccion_vendedor","like", '%'.$this->buscador.'%');
                                            })->get();   
            }
        }
        else 
        {
            $this->vendedores = Vendedor::where("idagente", "=", Auth::user()->idagente)
                                ->where("estatus", "=", $this->status)
                                ->get();
        }
        return view('livewire.vendedor.show-controller');
    }

    public function lock($idvendedor)
    {
        $vendedor = Vendedor::where("idvendedor","=", $idvendedor)->first();
        $vendedor->estatus = 'BLO';
        $vendedor->save();
    }

    public function unlock($idvendedor)
    {
        $vendedor = Vendedor::where("idvendedor","=", $idvendedor)->first();
        $vendedor->estatus = 'ACT';
        $vendedor->save();
    }

    public function reiniciar_password($idvendedor)
    {
        $this->skipRender();
        $vendedor = Vendedor::where("idvendedor","=", $idvendedor)->first();
        $vendedor->clave = Hash::make('000000');;
        $vendedor->save();        
    }

    public function guardarVendedor($parametros)
    {
        $parametros = json_decode($parametros);

        $vendededor = vendedor::where('idvendedor', $parametros->idvendedor)->first();
        $vendededor->nombre_vendedor    =  $parametros->nombre_vendedor;
        $vendededor->email_vendedor     =  $parametros->email_vendedor;
        $vendededor->idciudad           =  $parametros->idciudad;
        $vendededor->direccion_vendedor =  $parametros->direccion_vendedor;
        $vendededor->telefono_vendedor  =  $parametros->telefono_vendedor;
        $vendededor->porc_animalitos    =  $parametros->porc_animalitos;


        /*$vendedor = new Vendedor;        
        $this->post->nombre_vendedor      = $this->nombre_vendedor;
        $this->post->email_vendedor       = $this->email_vendedor;
        $this->post->telefono_vendedor    = $this->telefono_vendedor;
        $this->post->direccion_vendedor   = $this->direccion_vendedor;
        $this->post->idciudad             = $this->idciudad;                
        $this->post->porc_animalitos      = $this->porc_animalitos;*/    
        //$this->post->save();
        //$this->mensaje = $parametros->nombre_vendedor;
        //$this->emit('MostrarVendedores');
        //$this->emit('render');
        $vendededor->save();
    }

    
}
