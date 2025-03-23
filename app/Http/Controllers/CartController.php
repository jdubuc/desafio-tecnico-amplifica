<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class CartController extends Controller
{
    public function index()
    {
        //verificamos el token JWT
        $token = User::getJwtToken();
        $productosActivos = Product::getAllProducts(); 
        return view('carrito', compact('productosActivos'));
    }

    public function store(Request $request)
    {
        //verificamos el token JWT
        $token = User::getJwtToken();
        $productosSeleccionados = $request->input('productos', []);
        if(empty($productosSeleccionados)){
            return back()->withErrors('Debes elegir al menos un producto');
        }
        Session::put('carrito', $productosSeleccionados);

        return redirect()->route('rate.index')->with('success', 'Productos agregados al carrito.');
    }
}
