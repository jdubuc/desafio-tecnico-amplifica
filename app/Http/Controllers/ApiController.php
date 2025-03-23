<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmplificaService;

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
