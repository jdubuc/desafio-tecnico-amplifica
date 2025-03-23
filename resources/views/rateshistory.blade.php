


@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Historial de Tarifas</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <table class="table table-striped">
            <thead>
                <tr>
                <th>Nombre</th>
                <th>Código</th>
                <th>Precio</th>
                <th>Días de Tránsito</th>
                <th>Veces Consultada</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($ratesHistory as $rate)
                <tr>
                    <td>{{ $rate->name }}</td>
                    <td>{{ $rate->code }}</td>
                    <td>${{ number_format($rate->price, 2) }}</td>
                    <td>{{ $rate->transit_days }}</td>
                    <td>{{ $rate->count }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>

@endsection