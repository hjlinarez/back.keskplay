<?php

namespace App\Http\Livewire\Vendedor;


use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Faker\Factory as Faker;

class JugadasanimalitosController extends Component
{
    public $jugadas;
    public $pagoTotal;

    protected $listeners = ['actualizarJugadas'];


    public function mount()
    {
        
        
        if (session()->has('jugadas'))
        {
            $this->jugadas = session()->get('jugadas');
        }
        else 
        {
            $this->jugadas = array();
            session(['jugadas' =>$this->jugadas]);
            
        }
             
    }

    public function render()
    {
        // caolculo del monto
        
        $jugadas = $this->jugadas;

        $this->pagoTotal = 0;        
        foreach($jugadas as $jugada)
        {
            $this->pagoTotal +=  $jugada["monto"] ;
        }

        

        return view('livewire.vendedor.jugadasanimalitos-controller');
    }

    public function actualizarJugadas()
    {
        
        //$faker = Faker::create();
        //$jugadas =        
        //$jugadas[] = ["id" => $faker->unique()->randomDigit, "opcion" => $faker->name(), "monto" => $faker->unique()->randomDigit];                
        //session(['jugadas' =>$jugadas]);

        $this->jugadas =  session()->get('jugadas'); 
        //Auth::user()->jugadas = $this->jugadas;
    }

    public function borrarJugadas()
    {
        $this->jugadas = array();
        $this->pagoTotal = 0;
        session(['jugadas' =>$this->jugadas]);
    }

    public function borrarItem($pos)
    {
        $jugadas = session()->get('jugadas'); 
        unset($jugadas[$pos]);
        $this->jugadas = $jugadas;        
        session(['jugadas' =>$this->jugadas]);
    }
}
