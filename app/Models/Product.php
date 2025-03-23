<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'available_quantity', 'weight', 'description', 'active'];

    public static function getAllProducts()
    {
        return self::where('active', true)->get();
    }
}
