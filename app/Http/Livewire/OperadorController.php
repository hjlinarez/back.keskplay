<?php

namespace App\Http\Livewire;
use DB;
use Livewire\Component;
use App\Models\Cajas;
use App\Models\Recargasopera;
use App\Models\Operador;
use App\Models\Monedas;
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
    public $monedas;
    public $idmoneda = 'ALL';
    public $idmoneda_recarga = '';

    
    protected $listeners = [
                            'RegistrarOperador'=>'RegistrarOperador', 
                            'refreshOperador' => 'render'
                        ];

    


    public function mount()
    {
        
        $this->filtro = '';
        $this->estatus = 'ALL';
        $this->saldo_operador = 0;
        $this->monto_recarga = 0;
        $this->data = [];
        //$this->idmoneda = auth::user()->idmoneda;
        $this->suboperadores = auth::user()->suboperadores;


        $this->idmoneda = 'ALL';
        if (auth::user()->idpadre == 0) {            
            $this->monedas = Monedas::get();            
        } else {
            $this->monedas = Monedas::where('idmoneda','=', auth::user()->idmoneda)->get();                        
        }

        //$this->operador ["name"] = '';
        //$this->operador["email"] = '';
        //$this->operador["suboperadores"] = 0;

        $this->operador = new Operador;

    }


    public function render()
    {
        $query = Operador::where('name', 'like', '%'.$this->filtro.'%')
                     ->where('idpadre', auth()->user()->perfil == 'MASTER' ? 0 : auth()->user()->id);

        if (auth()->user()->perfil == 'MASTER') {
            $query->where('perfil', 'OPERA');
        }

        if ($this->estatus !== 'ALL') {
            $query->where('estatus', $this->estatus);
        }

        if ($this->idmoneda !== 'ALL') {
            $query->where('idmoneda', $this->idmoneda);
        }

        $this->data = $query->get();
        

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
        $this->idmoneda_recarga = $operador->idmoneda;     
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
            //$this->emit('mensaje', "Exito", "La recarga se realizo satisfactoriamente", "success"); 

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
