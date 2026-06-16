@extends('layouts.app')

@section('topbar-title', 'Registrar leitura')

@section('content')
<div class="card" style="max-width: 620px;">
    <h1 style="margin-bottom: 18px;">📊 Registrar Leitura Mensal</h1>

    <form method="POST" action="{{ route('leituras.store') }}">
        @csrf

        <label for="consumidor_id">Consumidor</label>
        <select id="consumidor_id" name="consumidor_id" required>
            <option value="">— Selecione —</option>
            @foreach($consumidores as $consumidor)
                <option value="{{ $consumidor->id }}" {{ old('consumidor_id') == $consumidor->id ? 'selected' : '' }}>
                    {{ $consumidor->nome }} (Med: {{ $consumidor->numero_medidor }})
                </option>
            @endforeach
        </select>

        <div class="grid-2">
            <div>
                <label for="mes_referencia">Mês</label>
                <select id="mes_referencia" name="mes_referencia" required>
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ old('mes_referencia', now()->month) == $m ? 'selected' : '' }}>
                            {{ str_pad($m, 2, '0', STR_PAD_LEFT) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="ano_referencia">Ano</label>
                <input id="ano_referencia" type="number" name="ano_referencia" value="{{ old('ano_referencia', now()->year) }}" min="2000" max="2100" required>
            </div>
        </div>

        <label for="leitura_atual">Leitura atual do medidor (m³)</label>
        <input id="leitura_atual" type="number" name="leitura_atual" value="{{ old('leitura_atual') }}" step="0.001" min="0" required>

        <p class="muted" style="margin-top: -6px; margin-bottom: 16px;">
            A leitura anterior será calculada automaticamente com base no último registro do consumidor.
        </p>

        <div style="display:flex; gap:12px;">
            <button type="submit" class="btn btn-primary">📥 Registrar</button>
            <a href="{{ route('dashboard') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>
@endsection
