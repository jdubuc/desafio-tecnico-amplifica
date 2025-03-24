<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmplificaService;

//controlador en caso de querer usar las llamada a api desde el front, tener disponibles los servicios , falta agregar rutas
class ApiController extends Controller
{
    private $amplificaService;

    public function __construct(AmplificaService $amplificaService)
    {
        $this->amplificaService = $amplificaService;
    }

    public function getRegions()
    {
        return response()->json($this->amplificaService->getRegionalConfig());
    }

    public function getRates(Request $request)
    {
        $rates = $this->amplificaService->getRate($request->comuna, $request->products);
        return response()->json($rates);
    }
}
