<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateHistory extends Model
{
    
    protected $table = 'rates_history';
    
    protected $fillable = ['name', 'code', 'price', 'transit_days', 'count'];

    //aca guardo el historial de tarifas, pero si una tarifa se repite, subo la cantidad a esa tarifa que ya existe, eso permite saber que tarifas se consultan mas, un reporte en el historial?
    public static function storeRate($rateData)
    {
        $rate = self::where([
            'name' => $rateData['name'],
            'code' => $rateData['code'],
            'price' => $rateData['price'],
            'transit_days' => $rateData['transitDays'],
        ])->first();

        if ($rate) {
            $rate->increment('count');
        } else {
            self::create([
                'name' => $rateData['name'],
                'code' => $rateData['code'],
                'price' => $rateData['price'],
                'transit_days' => $rateData['transitDays'],
                'count' => 1,
            ]);
        }
    }
}
