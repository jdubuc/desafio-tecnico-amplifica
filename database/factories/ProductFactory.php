<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        //lista de productos para generar datos de prueba
        $productNames = [
            'Laptop Gamer', 'Teléfono Inteligente', 'Smartwatch', 'Cámara Digital', 'Auriculares Bluetooth',
            'Teclado Mecánico', 'Monitor 4K', 'Silla Ergonómica', 'Mouse Inalámbrico', 'Impresora Láser',
            'Disco Duro Externo', 'Tablet Android', 'Micrófono Profesional', 'Cargador Portátil', 'Altavoz Bluetooth'
        ];

        return [
            'name' => $this->faker->randomElement($productNames),
            'available_quantity' => $this->faker->numberBetween(1, 10),
            'weight' => $this->faker->randomFloat(2, 0.5, 15), // Peso entre 0.5  y 15 
            'description' => $this->faker->sentence(10),
            'active' => $this->faker->boolean(70), // 70% true, 30% false creando random activos, favoreciendo activos
        ];
    }
}
