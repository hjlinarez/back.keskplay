<?php

namespace App\Http\Livewire;
use DB;
use Livewire\Component;
use App\Models\Cajas;
use App\Models\Recargas;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\FlareClient\Context\RequestContextProvider;



class CajaController extends Component
{   
    public $caja;
    protected $rules = [
                        'caja.name'=> 'required',
                        'caja.email'=> 'required',
                        'caja.login'=> 'required',
                        'caja.apuesta_minima'=> 'required',
                        'caja.apuesta_maxima'=> 'required',
                        'caja.pagos'=> 'required',

                        'caja.acumulado_mini_jackpot'=> 'required',
                        'caja.porc_mini_jackpot'=> 'required',
                        'caja.limite_mini_jackpot'=> 'required',
                        'caja.porc_entrega_mini_jackpot'=> 'required',

                        'caja.acumulado_super_jackpot'=> 'required',
                        'caja.porc_super_jackpot'=> 'required',
                        'caja.limite_super_jackpot'=> 'required',
                        'caja.porc_entrega_super_jackpot'=> 'required',

                        'caja.acumulado_mega_jackpot'=> 'required',
                        'caja.porc_mega_jackpot'=> 'required',
                        'caja.limite_mega_jackpot'=> 'required',
                        'caja.porc_entrega_mega_jackpot'=> 'required'
                    ];




    public $data;
    public $filtro;
    public $estatus;

    // variables para las recargas
    public $saldo_operador;



    public $monto_recarga;
    public $idusuario_recarga;

    public $idmoneda;

    public $historicoRecargas;
    
    public function mount()
    {
        $this->filtro = '';
        $this->estatus = 'ALL';
        $this->saldo_operador = 0;
        $this->monto_recarga = 0;

        $this->caja = new Cajas;

        $this->idmoneda = auth::user()->idmoneda;


    }

    public function render()
    {
        if ($this->estatus == 'ALL')
        {
            $this->data = Cajas::where('name', 'like', '%'.$this->filtro.'%')
                        ->where('idopera', '=', auth::user()->id)
                        ->get();
        }
        else 
        {
            $this->data = Cajas::where('name', 'like', '%'.$this->filtro.'%')
                                ->where('estatus', '=', $this->estatus)
                                ->where('idopera', '=', auth::user()->id)
                                ->get();
        }
        
        return view('livewire.caja-controller');
    }


    public function editcaja(Cajas $caja)
    {
        //$this->skipRender();
        $this->caja = $caja;        
        $this->emit('open_modal', 'modalEditCaja');         
    }

    

    public function GuardarCaja()
    {

        if ($this->caja->apuesta_minima <= 0)
        {            
            $this->emit('mensaje', "Disculpe", "Apuesta minima es invalida", "error");  
            return false;  
        } 
        
        
        
        if ($this->caja->name == null){ $this->emit('mensaje', "Disculpe", "Debe indicar el nombre de la caja", "error"); return false;} 
        if ($this->caja->email == null){ $this->emit('mensaje', "Disculpe", "Indique el correo electronico", "error"); return false;} 
        if ($this->caja->login == null){ $this->emit('mensaje', "Disculpe", "Indique el login de la caja", "error"); return false;} 
        


        $cantidad_opciones = count(explode(",",$this->caja->pagos));
        if ($cantidad_opciones <= 1) { $this->emit('mensaje', "Disculpe", "Campo 'Opciones de Pago' es invalido ".$cantidad_opciones, "error"); return false;} 

        

        

        if ($this->caja->apuesta_maxima <= 0)
        {
            $this->emit('mensaje', "Disculpe", "Apuesta Maxima es invalida", "error"); 
            return false;
        }

        if ($this->caja->apuesta_maxima <= $this->caja->apuesta_minima)
        {
            $this->emit('mensaje', "Disculpe", "Apuesta maxima deber ser mayor que la apuesta minima", "error"); 
            return false;
        }

        //validacion del MINI jakcpo
        if ($this->caja->acumulado_mini_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto inicial del mini jackpot es invalido", "error"); 
            return false;
        }

        if ($this->caja->porc_mini_jackpot < 0 or $this->caja->porc_mini_jackpot >= 5)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de recoleccion del mini jackpot maximo debe ser el 5%", "error"); 
            return false;
        }

        if ($this->caja->limite_mini_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto limite de entrega del mini jackpot es invalido", "error"); 
            return false;
        }

        if ($this->caja->porc_entrega_mini_jackpot < 0 or $this->caja->porc_entrega_mini_jackpot >= 100)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de entrega del mini jackpot es invalido", "error"); 
            return false;
        }

        //validacion del SUPER jakcpo
        if ($this->caja->acumulado_super_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto inicial del super jackpot es invalido", "error"); 
            return false;
        }

        if ($this->caja->porc_super_jackpot < 0 or $this->caja->porc_super_jackpot >= 5)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de recoleccion de super jackpot maximo debe ser el 5%", "error"); 
            return false;
        }

        if ($this->caja->limite_super_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto limite de entrega super jackpot es invalido", "error"); 
            return false;
        }

        if ($this->caja->porc_entrega_super_jackpot < 0 or $this->caja->porc_entrega_super_jackpot >= 100)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de entrega del super jackpot es invalido", "error"); 
            return false;
        }

        //validacion del MEGA jakcpo
        if ($this->caja->acumulado_mega_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto inicial del mega jackpot es invalido", "error"); 
            return false;
        }

        if ($this->caja->porc_mega_jackpot < 0 or $this->caja->porc_mega_jackpot >= 5)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de recoleccion del mega jackpot maximo debe ser el 5%", "error"); 
            return false;
        }

        if ($this->caja->limite_mega_jackpot < 0)
        {
            $this->emit('mensaje', "Disculpe", "El monto limite de entrega del super jackpot es invalido", "error"); 
            return false;
        }

        if ($this->caja->porc_entrega_mega_jackpot < 0 or $this->caja->porc_entrega_mega_jackpot >= 100)
        {
            $this->emit('mensaje', "Disculpe", "El porcentaje de entrega de mega jackpot es invalido", "error"); 
            return false;
        }

        try {
            if ($this->caja->save())
            {
                $this->emit('close_modal', 'modalEditCaja');
                $this->emit('mensaje', "Exito", "Registro actualizado","success"); 
                
            }
        } catch (\Exception $e) {
            
            $this->emit('mensaje', "Disculpe", $e->getMessage(), "error"); 
        }


    }


    public function recargaSaldoCaja(Cajas $caja)
    {
        
        $this->idusuario_recarga = $caja->id;        
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

        $recarga = new Recargas;

        $recarga->iduser        = $this->idusuario_recarga;
        $recarga->monto         = $this->monto_recarga;
        $recarga->idmoneda      = auth::user()->idmoneda;        
        $recarga->idopera       = auth::user()->id;

        if ($recarga->save())
        {
            $caja = Cajas::where('id', '=', $recarga->iduser)->first();
            $caja->saldo += $recarga->monto;
            $caja->save();  
            $this->emit('close_modal', 'modalRecargaSaldo');
            $this->emit('mensaje', "Exito", "La recarga se realizo satisfactoriamente", "success"); 

        }



        
    }


    public function historicoRecargas(Cajas $caja)
    {
        
        //$this->idusuario_recarga = $caja->id;        
        //$this->monto_recarga = 0;        
        $this->emit('open_modal', 'modalHistoricoRecargas');
    }


    public function bloquearCaja(Cajas $caja)
    {
        $caja->estatus = 'BLO';
        $caja->save();
    }

    public function desbloquearCaja(Cajas $caja)
    {
        $caja->estatus = 'ACT';
        $caja->save();
    }
}
