<?php

namespace App\Http\Livewire\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

use App\Models\User;
use App\Models\Vendedor;
use App\Models\Agente;
use App\Models\Operador;


use Livewire\Component;

class CambiarpasswordController extends Component
{
    public $password;
    public $newpassword;
    public $repitepassword;
    public $passwordactual;
    public $message;

    public function mount()
    {
        //$this->password = Auth::user()->password;
    }

    public function render()
    {
        
        return view('livewire.user.cambiarpassword-controller');
    }


    public function cambiarPassword()
    {

   

            if (!Hash::check($this->password, Auth::user()->password))        
            {
                $this->dispatchBrowserEvent('message', ['title'=>'Disculpe','message' => 'La "Clave actual" no coincide con la registrada.', 'type'=>'error']);
            }             
            elseif ($this->newpassword <> $this->repitepassword)
            {
                $this->dispatchBrowserEvent('message', ['title'=>'Disculpe','message' => 'Las claves no coinciden', 'type'=>'error']);
            }
            elseif(Hash::check($this->newpassword, Auth::user()->password))
            {
                $this->dispatchBrowserEvent('message', ['title'=>'Disculpe','message' => 'Esta clave ya fue usada', 'type'=>'error']);
            }
            else
            {
                $request = new Request([        
                                        'newpassword'=>$this->newpassword
                                    ]);


                $validate = Validator::make($request->all(),['newpassword'=>'required|min:5|max:15']);
                
                if ($validate->fails())
                {
                    //$this->message = '*Campo obligatorio';
                    $this->dispatchBrowserEvent('message', ['title'=>'Disculpe','message' => 'La "Nueva clave" no coincide con las politicas de seguridad. Caracateres minimos 5, maximo 15', 'type'=>'error']);
                }
                else 
                {
                    if (Auth::user()->tipo == 'Operador') $usuario = Operador::where('idoperador', Auth::user()->idoperador)->first();        
                    if (Auth::user()->tipo == 'Agente') $usuario = Agente::where('idagente', Auth::user()->idagente)->first();
                    if (Auth::user()->tipo == 'Taquilla') $usuario = Vendedor::where('idvendedor', Auth::user()->idvendedor)->first();
                    $usuario->password = hash::make($this->newpassword);
                    if ($usuario->save())            
                    {
                        $this->dispatchBrowserEvent('message', ['title'=>'Exito','message' => 'La clave se registro.', 'type'=>'success']);            
                        return redirect('logout');
                    }
                    else             
                        $this->dispatchBrowserEvent('message', ['title'=>'Disculpe','message' => 'No se pudo modificar la clave', 'type'=>'error']);
                }

                
                
            }

        
            
        


        



        
        
        
    }
}
