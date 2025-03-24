<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use App\Services\AmplificaService;

class ApiTest extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new AmplificaService();
    }

    /** @test */
    public function it_authenticates_and_returns_a_token()
    {
        // Limpia caché antes de probar
        Cache::forget('jwt_token');

        // Llamar a authenticate() mediante un método público
        $token = $this->service->authenticate();
        $token = Cache::get('jwt_token');
        
        // Verificar que el token fue obtenido
        $this->assertNotEmpty($token, 'El token JWT no debería estar vacío');

        // Verificar que el token se almacenó en caché
        $this->assertEquals($token, Cache::get('jwt_token'));
    }

    /** @test */
    public function it_fetches_regional_config()
    {
        // Limpia caché antes de probar
        Cache::forget('regionalConfig');
        Cache::forget('jwt_token');

        // Llamar a authenticate() mediante un método público
        $this->service->authenticate();
        // Llamar a la función real
        $response = $this->service->getRegionalConfig();
        
        // Verificar que la respuesta tenga los campos esperados
        //mejora: no usar el indice [0] sino verificar la respuesta completa
        $this->assertArrayHasKey('code', $response[0], 'La respuesta debe contener "code"');
        $this->assertArrayHasKey('region', $response[0], 'La respuesta debe contener "region"');
        $this->assertArrayHasKey('comunas', $response[0], 'La respuesta debe contener "comunas"');

        $this->assertNotEmpty($response[0]['code'], 'code no debería estar vacío');
        $this->assertNotEmpty($response[0]['region'], 'La lista de regiones no debería estar vacía');
        $this->assertNotEmpty($response[0]['comunas'], 'La lista de comunas no debería estar vacía');
    }
}