<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Services\AmplificaService;
use App\Models\RateHistory;
use App\Models\User;


class RateController extends Controller
{
    private $amplificaService;

    public function __construct(AmplificaService $amplificaService)
    {
        $this->amplificaService = $amplificaService;
    }

    public function index()
    {
        try {
            //verificamos el token JWT
            $token = User::getJwtToken();

            $productos = Session::get('carrito');
            $comuna = Session::get('destino.comuna');

            //le doi la forma esperada al array para consultar el servicio
            $productosGetRate = array_map(function($item) {
                return [
                    'weight' => (int) round($item['weight'], 0),
                    'quantity' => (int) $item['quantity'],
                ];
            }, $productos);

            $rates = $this->amplificaService->getRate($comuna, $productosGetRate);

            if(array_key_exists('message', $rates)){
                return back()->withErrors($rates['message']);
            }
            
            //guardo la respuesta en el historial de tarifas
            foreach ($rates as $rate) {
                RateHistory::storeRate($rate);
            }

            return view('tarifas', compact('rates'));
        } catch (\Exception $e) {
            return back()->withErrors('Error al obtener tarifas, '. $e);
        }
    }

    public function store(Request $request)
    {
        Session::forget('destino');
        Session::forget('carrito');
        
        return view('success');
    }

    public function showHistory()
    {
        $ratesHistory = RateHistory::orderByDesc('count')->get();
        return view('rateshistory', compact('ratesHistory'));
    }
}
