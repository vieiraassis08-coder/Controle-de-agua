@extends('layouts.app')

@section('content')
<div class="card" style="max-width:520px;">
    <h1>📊 Registrar Leitura Mensal</h1>

    <form method="POST" action="{{ route('leituras.store') }}">
        @csrf

        <label>Consumidor</label>
        <select name="consumidor_id" required>
            <option value="">— Selecione —</option>
            @foreach($consumidores as $c)
                <option value="{{ $c->id }}" {{ old('consumidor_id') == $c->id ? 'selected' : '' }}>
                    {{ $c->nome }} (Med: {{ $c->numero_medidor }})
                </option>
            @endforeach
        </select>

        <div class="row">
            <div class="col">
                <label>Mês</label>
                <select name="mes_referencia" required>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ old('mes_referencia', date('n')) == $m ? 'selected' : '' }}>
                            {{ str_pad($m, 2, '0', STR_PAD_LEFT) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label>Ano</label>
                <input type="number" name="ano_referencia" value="{{ old('ano_referencia', date('Y')) }}" min="2000" max="2100" required>
            </div>
        </div>

        <label>Leitura Atual do Medidor (m³)</label>
        <input type="number" name="leitura_atual" value="{{ old('leitura_atual') }}" step="0.001" min="0" required placeholder="Ex: 125.340">

        <p style="font-size:0.83rem; color:#666; margin-top:-10px; margin-bottom:14px;">
            ℹ️ A leitura anterior é obtida automaticamente do último registro.
        </p>

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-primary">📥 Registrar</button>
            <a href="{{ route('consumidores.index') }}" class="btn" style="background:#e5e7eb; color:#333;">Cancelar</a>
        </div>
    </form>
</div>
@endsection
