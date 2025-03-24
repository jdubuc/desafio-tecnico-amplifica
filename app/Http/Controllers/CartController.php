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
        //buscamos todos los productos
        $productosActivos = Product::getAllProducts(); 
        return view('carrito', compact('productosActivos'));
    }

    public function store(Request $request)
    {
        //verificamos el token JWT
        $token = User::getJwtToken();
        //recibimos los productos seleccionados
        $productosSeleccionados = $request->input('productos', []);

        //redireccionamos si no hay ninguno
        if(empty($productosSeleccionados)){
            return back()->withErrors('Debes elegir al menos un producto');
        }
        //como no hay un servicio para guardar los productos, por el momento se guardan en sesion, se podria guardar directamente en BD y hacer migraciones tambien
        Session::put('carrito', $productosSeleccionados);

        return redirect()->route('rate.index')->with('success', 'Productos agregados al carrito.');
    }
}
