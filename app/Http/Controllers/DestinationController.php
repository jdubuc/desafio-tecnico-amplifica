<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\AmplificaService;


class DestinationController extends Controller
{
    private $amplificaService;

    public function __construct(AmplificaService $amplificaService)
    {
        $this->amplificaService = $amplificaService;
    }

    public function index()
    {
        try {
            //Limpiamos sesion
            // if (Cache::has('jwt_token')) {
            //     Cache::forget('jwt_token');
            // }
            Session::forget('destino');
            Session::forget('carrito');
            //iniciamos una nueva obteniendo el token JWT
            $token = User::getJwtToken();
            
            //obtenemos regiones y comunas del servicio
            $regionalConfig = $this->amplificaService->getRegionalConfig();
            
            return view('destinos', compact('regionalConfig'));
        } catch (\Exception $e) {
            return back()->withErrors('Error al cargar regiones y comunas');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'region' => 'required|string',
            'comuna' => 'required|string',
        ]);
        //como no hay un servicio para guardar los seleccionado, por el momento se guardan en sesion, se podria guardar directamente en BD y hacer migraciones tambien
        Session::put('destino.region',$request->region);
        Session::put('destino.comuna',$request->comuna);
        
        return redirect()->route('carrito.index');
    }
}
