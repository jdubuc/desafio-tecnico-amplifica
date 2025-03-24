<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AmplificaService
{
    private $baseUrl = 'https://postulaciones.amplifica.io'; //se deberia colocar en el ENV
    private $token;

    public function __construct()
    {
        $this->authenticate();
    }

    public function authenticate() 
    {
        $cachedToken = Cache::get('jwt_token');

        if (!$cachedToken) {
            $response = Http::post("{$this->baseUrl}/auth", [
                'username' => env('AMPLIFICA_USERNAME'),
                'password' => env('AMPLIFICA_PASSWORD'),
            ]);

            if ($response->successful()) {
                $token = $response->json()['token'];
                Cache::put('jwt_token', $token,  now()->addSeconds(55));
                $this->token = $token;
            } else {
                throw new \Exception('Error al autenticar con la API de Amplifica');
            }
        } else {
            $this->token = $cachedToken;
        }
    }

    public function getRegionalConfig()
    {
        //Optimización del rendimiento en las consultas a la API
        //se podria usar algo como memcached para guardar a largo plazo este tipo de consultas y no repetirlas
        if(Cache::has('regionalConfig')){
            return Cache::get('regionalConfig');
        }else{
            $response = Http::withToken($this->token)->get("{$this->baseUrl}/regionalConfig");
            Cache::put('regionalConfig', $response->json(), 60); //por 1 min
            return $response->json();
        }
        
    }

    public function getRate($comuna, $products)
    {
        $body = [
            'comuna' => $comuna,
            'products' => array_values($products)
        ];
       
        $response = Http::withToken($this->token)
        ->withHeaders(['Content-Type' => 'application/json'])
        ->post("{$this->baseUrl}/getRate", $body);

        return $response->json();
    }
}