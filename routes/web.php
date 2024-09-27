<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Auth;
use App\Models\Ciudades;
use App\Models\Loterias;


Route::middleware('auth:web')->group(function () {
    
    Route::get('/', [App\Http\Controllers\homeController::class, 'index'])->name('inicio');
    //Route::get('Dashboard', [App\Http\Controllers\homeController::class, 'index'])->name('Dashboard');


    Route::get('operador', function(){
        return view('operador');
    })->name('operador');


    Route::get('cajas', function(){
        return view('cajas');
    })->name('cajas');


    Route::get('NuevaCaja', function(){
        return view('cajanueva');
    });

  





    Route::get('DataGrafico', [App\Http\Controllers\homeController::class, 'grafico']);
    //Route::get('Vendedores', [App\Http\Controllers\Vendedor\VendedorController::class, 'index']);
    Route::get('Vendedores', function(){
        return view('vendedores');
    });

    Route::get('ResumenVenta', function(){
        return view('resumenventa');
    });

    Route::get('animalitos', function(){
        return view('animalitos');
    });
    Route::get('triples', function(){
        return view('triples');
    });
    
    

    Route::get('CambiarPassword', function(){
        return view('auth.changepassword');
    });

    Route::post('CambiarPassword', [App\Http\Controllers\homeController::class, 'CambiarPassword']);


    Route::get('paisCiudades/{idpais}', function($idpais){
        return Ciudades::Where("idpais",$idpais)->OrderBy('ciudad')->get();
    })->name('paisCiudades');
    Route::post('StoreVendedor', [\App\Http\Controllers\Vendedor\VendedorController::class, 'store'] )->name('StoreVendedor');
    Route::get('Vendedor-{idvendedor}', function($idvendedor){
        return view('vendedor',["idvendedor"=>$idvendedor]);
    })->name('Vendedor');



    //Route::get('Vendedor-{idvendedor}', LoteriaController::class)->name('Vendedor');
    Route::post('api/NuevoTicket', [\App\Http\Controllers\TicketController::class, 'NuevoTicket'] );
    Route::get('api/ListaTicketAnular', [\App\Http\Controllers\TicketController::class, 'ListaTicketAnular'] );
    Route::post('api/AnularTicket', [\App\Http\Controllers\TicketController::class, 'anularTicket'] );
    Route::get('Ticket-{idticket}', [\App\Http\Controllers\TicketController::class, 'PrintTicket'] )->name('Ticket');











});


//Route::get('xxx/{idticket}', [\App\Http\Controllers\TicketController::class, 'infoTicket'] );
//Route::get('ChangePasswordAll', [\App\Http\Controllers\Agente\AgenteController::class, 'cambiarPasswordAll']);

Route::get('logout', [\App\Http\Controllers\Authentic\LoginController::class, 'logout']);
Route::get('login',function(){ return view('auth.login'); })->name('login');
Route::post('login', [\App\Http\Controllers\Authentic\LoginController::class, 'login']);
Route::POST('verificarUsuario', [\App\Http\Controllers\Authentic\LoginController::class, 'verificarUsuario'])->name('verificarUsuario');




