@extends('layouts.app')

@section('topbar-title', 'Configuração')

@section('content')
<div class="card" style="max-width: 560px;">
    <h1 style="margin-bottom: 8px;">⚙️ Configuração da Taxa</h1>
    <p class="muted" style="margin-bottom: 18px;">
        Ajuste os valores usados no cálculo das faturas.
    </p>

    <form method="POST" action="{{ route('configuracao.update') }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col">
                <label for="taxa_fixa">Taxa fixa</label>
                <input id="taxa_fixa" type="number" name="taxa_fixa" value="{{ old('taxa_fixa', $config->taxa_fixa) }}" step="0.01" min="0" required>
            </div>
            <div class="col">
                <label for="limite_isento">Limite isento (litros)</label>
                <input id="limite_isento" type="number" name="limite_isento" value="{{ old('limite_isento', $config->limite_isento) }}" min="0" required>
            </div>
        </div>

        <label for="valor_excedente">Valor por 1.000 L excedentes</label>
        <input id="valor_excedente" type="number" name="valor_excedente" value="{{ old('valor_excedente', $config->valor_excedente) }}" step="0.01" min="0" required>

        <div style="background:#f7f9fb; padding:12px; border-radius:10px; margin-bottom:16px; font-size:0.9rem; color:#555;">
            <strong>Exemplo de cálculo:</strong><br>
            Consumo de 15 m³ → R$ {{ number_format($config->taxa_fixa, 2, ',', '.') }} (fixa)
            + R$ {{ number_format((15 - ($config->limite_isento / 1000)) * $config->valor_excedente, 2, ',', '.') }}
            = <strong>R$ {{ number_format($config->calcularFatura(15), 2, ',', '.') }}</strong>
        </div>

        <button type="submit" class="btn btn-primary">💾 Salvar</button>
    </form>
</div>
@endsection
