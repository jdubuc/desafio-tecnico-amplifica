@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Selecciona un de las tarifas</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rate.store') }}" method="POST">
        @csrf
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Precio (CLP)</th>
                    <th>Llegará en</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($rates as $rate)
                <tr>
                    <td>
                        <input type="checkbox" class="rate-checkbox" data-id="{{ $rate['code'] }}">
                        <input type="hidden" name="rates[{{ $rate['code'] }}][code]" value="{{ $rate['code'] }}" class="rate-code" disabled>
                        <input type="hidden" name="rates[{{ $rate['price'] }}][price]" value="{{ $rate['price'] }}" class="rate-price" disabled>
                    </td>
                    <td>{{ $rate['name'] }}</td>
                    <td>{{ $rate['code'] }}</td>
                    <td>${{ number_format($rate['price'], 0, ',', '.') }}</td>
                    <td>{{ $rate['transitDays'] }} días</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll(".rate-checkbox");

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                const rateId = this.dataset.code;
                const codeInput = document.querySelector(`.rate-code[data-id="${rateId}"]`);
                const rateIdInput = document.querySelector(`input[name="rates[${rateId}][code]"]`);
                const ratepriceInput = document.querySelector(`input[name="rates[${rateId}][price]"]`);

                if (this.checked) {
                    codeInput.disabled = false;
                    codeInput.name = `rates[${rateId}][code]`;
                    rateIdInput.disabled = false;
                    ratepriceInput.disabled = false;
                } else {
                    codeInput.disabled = true;
                    codeInput.removeAttribute("name");
                    rateIdInput.disabled = true;
                    ratepriceInput.disabled = true;
                }
            });
        });
    });
</script>
@endsection