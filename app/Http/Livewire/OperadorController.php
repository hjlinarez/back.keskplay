<?php

namespace App\Http\Livewire;
use DB;
use Livewire\Component;
use App\Models\Cajas;
use App\Models\Recargasopera;
use App\Models\Operador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\FlareClient\Context\RequestContextProvider;





class OperadorController extends Component
{

    public $data;
    public $operador;
    protected $rules = [
                            'operador.name'=> 'required',
                            'operador.email'=> 'required',
                            'operador.suboperadores'=> 'required'
                        ];

    public $idopera_recarga;
    public $monto_recarga;

    public $suboperadores = 0;

    
    protected $listeners = ['RegistrarOperador'=>'RegistrarOperador'];
    public function mount()
    {
        
        $this->filtro = '';
        $this->estatus = 'ALL';
        $this->saldo_operador = 0;
        $this->monto_recarga = 0;
        $this->data = [];
        $this->idmoneda = auth::user()->idmoneda;
        $this->suboperadores = auth::user()->suboperadores;

        //$this->operador ["name"] = '';
        //$this->operador["email"] = '';
        //$this->operador["suboperadores"] = 0;

        $this->operador = new Operador;

        


    }
    public function render()
    {
        if (auth()->user()->perfil == 'MASTER')
        {
            if ($this->estatus == 'ALL')
            {
                $this->data = Operador::where('name', 'like', '%'.$this->filtro.'%')
                                    ->where('idpadre', '=', 0)
                                    ->where('perfil', '=', 'OPERA')
                                    ->get();
            }
            else 
            {
                $this->data = Operador::where('name', 'like', '%'.$this->filtro.'%')
                                    ->where('estatus', '=', $this->estatus)
                                    ->where('idpadre', '=', 0)
                                    ->where('perfil', '=', 'OPERA')
                                    ->get();
            }
        }
        else 
        {
            if ($this->estatus == 'ALL')
            {
                $this->data = Operador::where('name', 'like', '%'.$this->filtro.'%')
                            ->where('idpadre', '=', auth::user()->id)
                            ->get();
            }
            else 
            {
                $this->data = Operador::where('name', 'like', '%'.$this->filtro.'%')
                                    ->where('estatus', '=', $this->estatus)
                                    ->where('idpadre', '=', auth::user()->id)
                                    ->get();
            }
        }
        

        return view('livewire.operador-controller');
    }

    public function  RegistrarOperador($operador)
    {
        
        


        if (empty($operador["name"]))
        {
            $this->emit('mensaje', "Lo siento", "El nombre es invalido", "error");     
            return false;
        }

        if (empty($operador["email"]))
        {
            $this->emit('mensaje', "Lo siento", "El email es invalido", "error");     
            return false;
        }
        

        $opera = new Operador;
        $opera->name = $operador["name"];
        $opera->email = $operador["email"];
        $opera->suboperadores = $operador["suboperadores"];

        $opera->idpadre = auth::user()->id;
        $opera->idmoneda = auth::user()->idmoneda;
        $opera->password = Hash::make('00000000');
        try {
            //code...
            $opera->save();
            $this->emit('close_modal', 'newOperador');
            $this->emit('mensaje', "Exito", "El operador se creo", "success");     
            
            

        } catch (\Throwable $th) {
            $this->emit('mensaje', "error", "El operador no se pudo crear", "error");     
            return false;
        }


    }



    public function edit(Operador $operador)
    {
        $this->operador = $operador;
        $this->emit('open_modal', 'modalEdit');         
    }



    public function GuardarOperador()
    {
        if (empty($this->operador->name))
        {
            $this->emit('mensaje', "Lo siento", "El nombre es invalido", "error");     
            return false;
        }

        if (empty($this->operador->email))
        {
            $this->emit('mensaje', "Lo siento", "El email es invalido", "error");     
            return false;
        }
        

        try {
            //code...
            $this->operador->save();
            $this->emit('close_modal', 'modalEdit');
            $this->emit('mensaje', "Exito", "El operador se guardo", "success");     
            
            

        } catch (\Throwable $th) {
            $this->emit('mensaje', "error", "El operador no se pudo guardar", "error");     
            return false;
        }


       

    }


    public function recargaSaldo(Operador $operador)
    {
        
        $this->idopera_recarga = $operador->id;        
        $this->monto_recarga = 0;        
        $this->emit('open_modal', 'modalRecargaSaldo');
    }

    public function procesarRecarga()
    {
        if ($this->monto_recarga <= 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto de recarga no es invalido", "error"); 
            return false;
        }

        $recarga = new Recargasopera;

        $recarga->idopera        = $this->idopera_recarga;
        $recarga->monto         = $this->monto_recarga;
        $recarga->idmoneda      = auth::user()->idmoneda;        
        

        if ($recarga->save())
        {
            $caja = Operador::where('id', '=', $recarga->idopera)->first();
            $caja->saldo += $recarga->monto;
            $caja->save();  
            $this->emit('close_modal', 'modalRecargaSaldo');
            $this->emit('mensaje', "Exito", "La recarga se realizo satisfactoriamente", "success"); 

        }



        
    }

    public function bloquear(Operador $operador)
    {
        $operador->estatus = 'BLO';
        $operador->save();
    }

    public function desbloquear(Operador $operador)
    {
        $operador->estatus = 'ACT';
        $operador->save();
    }

    

}
