<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Monedas;
use App\Models\Operador;
use Illuminate\Support\Facades\Auth;

class NewoperadorController extends Component
{
    public $operador;
    public $monedas;
    
    protected $rules = [
        'operador.name' => 'required|string',
        'operador.email' => 'required|email',
        'operador.suboperadores' => 'integer|min:0|max:1', // 0 o 1
        'operador.idpadre' => 'required',
        'operador.idmoneda' => 'required|exists:moneda,idmoneda',
    ];

    protected $messages = [
        'operador.name.required' => 'El nombre es obligatorio.',
        'operador.email.required' => 'El correo electrónico es obligatorio.',
        'operador.email.email' => 'El correo electrónico no tiene un formato válido.',
        'operador.suboperadores.required' => 'Debe indicar si permite el registro de suboperadores.',
        'operador.suboperadores.integer' => 'El valor de suboperadores debe ser un número.',
        'operador.idpadre.required' => 'El ID del operador padre es obligatorio.',
        'operador.idmoneda.required' => 'Debe seleccionar una moneda.',
        'operador.idmoneda.exists' => 'La moneda seleccionada no es válida.',
    ];

    protected $listeners = ['refreshData' => 'render'];

    public function mount()
    {
        $this->operador = new Operador;
        $this->operador->suboperadores = 0; // Por defecto, no permite suboperadores

        if (Auth::user()->idpadre == 0) {
            $this->monedas = Monedas::get();
        }
        else {
            $this->monedas = Monedas::where('idmoneda', Auth::user()->idmoneda)->get();
        }

        
    }

    public function render()
    {
        return view('livewire.newoperador-controller');
    }

    public function registrar()
    {
        try {
            $this->operador->idpadre = Auth::user()->id;
            $this->validate(); // Valida los datos automáticamente con mensajes en español

            
            
            if ($this->operador->save()) {
                $this->operador = new Operador;
                //$this->render();
                
                $this->emit('refreshOperador');
                $this->emit('close_modal', 'newOperador');
                $this->emit('mensaje', "Éxito", "Operador creado correctamente", "success");

                
                
            }
        } catch (\Exception $e) {
            $this->emit('mensaje', "Error", $e->getMessage(), "error");
        }
    }
}
