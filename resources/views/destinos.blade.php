@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Selecciona tu Destino</h1>

    <form action="{{ route('destinos.store') }}" method="POST">
        @csrf

        <!-- Select para la Región -->
        <div class="form-group">
            <label for="region">Región</label>
            <select id="region" name="region" class="form-control" required>
                <option value="">Selecciona una región</option>
                @foreach($regionalConfig as $region)
                    <option value="{{ $region['code'] }}">{{ $region['region'] }}</option>
                @endforeach
            </select>
        </div>

        <!-- Select para la Comuna -->
        <div class="form-group">
            <label for="comuna">Comuna</label>
            <select id="comuna" name="comuna" class="form-control" required>
                <option value="">Selecciona una comuna</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
</div>
@endsection

@section('jss')
<script>
    const regiones = @json($regionalConfig);

    const regionSelect = document.getElementById('region');
    const comunaSelect = document.getElementById('comuna');

    regionSelect.addEventListener('change', function() {
        const regionCode = this.value;
        const selectedRegion = regiones.find(region => region.code === regionCode);

        comunaSelect.innerHTML = '<option value="">Selecciona una comuna</option>';

        if (selectedRegion) {
            selectedRegion.comunas.forEach(comuna => {
                const option = document.createElement('option');
                option.value = comuna;
                option.textContent = comuna;
                comunaSelect.appendChild(option);
            });
        }
    });
</script>
@endsection