<?php
//use App\Models\Agente;
namespace App\Http\Controllers\Authentic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
                            "email"=>$request->email , 
                            "password" => $request->password
                        ];

        if (Auth::attempt($credentials))
        {            
            $request->session()->regenerate();
            return redirect()->intended(route('inicio'));
        }
        else 
        {
            echo "no encontrado";
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');        
    }

    public function verificarUsuario(Request $request)
    {
        //$params = json_decode($request);

        //return response()->json(["cod"=>200,"message"=>"Usuario Logueado"],200);

        $credentials = [
            "email"=>$request->email, 
            "password" => $request->password
        ];

        if (Auth::attempt($credentials))
        {            
            //$request->session()->regenerate();
            return response()->json(["cod"=>200,"message"=>"Usuario Logueado"],200);
            //return redirect()->intended(route('Dashboard'));
        }
        else 
        {
            return response()->json(["cod"=>401,"message"=>"Usuario no Encontrado"],200);
        }
    }
}