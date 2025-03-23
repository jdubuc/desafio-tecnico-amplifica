@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Selecciona los productos para tu carrito y asi poder evaluar las tarifas</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('carrito.store') }}" method="POST">
        @csrf
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Peso (kg)</th>
                    <th>Stock Disponible</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($productosActivos as $producto)
                <tr>
                    <td>
                        <input type="checkbox" class="product-checkbox" data-id="{{ $producto->id }}">
                        <input type="hidden" name="productos[{{ $producto->id }}][id]" value="{{ $producto->id }}" class="product-id" disabled>
                        <input type="hidden" name="productos[{{ $producto->id }}][weight]" value="{{ $producto->weight }}" class="product-weight" disabled>
                    </td>
                    <td>{{ $producto->name }}</td>
                    <td>{{ $producto->description }}</td>
                    <td>{{ $producto->weight }}</td>
                    <td>{{ $producto->available_quantity }}</td>
                    <td>
                        <input type="number" 
                               name="productos[{{ $producto->id }}][quantity]" 
                               min="1" 
                               max="{{ $producto->available_quantity }}" 
                               value="1" 
                               class="form-control product-quantity" 
                               data-id="{{ $producto->id }}"
                               disabled>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll(".product-checkbox");

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                const productId = this.dataset.id;
                const quantityInput = document.querySelector(`.product-quantity[data-id="${productId}"]`);
                const productIdInput = document.querySelector(`input[name="productos[${productId}][id]"]`);
                const productWeightInput = document.querySelector(`input[name="productos[${productId}][weight]"]`);

                if (this.checked) {
                    quantityInput.disabled = false;
                    quantityInput.name = `productos[${productId}][quantity]`;
                    productIdInput.disabled = false;
                    productWeightInput.disabled = false;
                } else {
                    quantityInput.disabled = true;
                    quantityInput.removeAttribute("name");
                    productIdInput.disabled = true;
                    productWeightInput.disabled = true;
                }
            });
        });
    });
</script>
@endsection