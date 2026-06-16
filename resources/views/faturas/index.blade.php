@extends('layouts.app')

@section('topbar-title', 'Faturas')

@section('content')
<div class="card">
    <h1 style="margin-bottom: 16px;">🧾 Faturas</h1>

    <form method="GET" action="{{ route('faturas.index') }}" style="display:flex; gap:12px; align-items:end; flex-wrap:wrap; margin-bottom:18px;">
        <div>
            <label for="mes">Mês</label>
            <select id="mes" name="mes">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $mes == $m ? 'selected' : '' }}>
                        {{ str_pad($m, 2, '0', STR_PAD_LEFT) }}
                    </option>
                @endfor
            </select>
        </div>
        <div>
            <label for="ano">Ano</label>
            <input id="ano" type="number" name="ano" value="{{ $ano }}" min="2000" max="2100">
        </div>
        <button type="submit" class="btn btn-primary">🔎 Filtrar</button>
    </form>

    @if($faturas->isEmpty())
        <p class="muted">Nenhuma fatura encontrada para {{ str_pad($mes, 2, '0', STR_PAD_LEFT) }}/{{ $ano }}.</p>
    @else
        <div class="grid-2">
            @foreach($faturas as $fatura)
                <div class="card" style="padding: 18px; border: 1px solid var(--border); box-shadow: none;">
                    <div style="display:flex; justify-content:space-between; align-items:center; gap: 10px; margin-bottom: 12px;">
                        <div>
                            <h3 style="margin: 0;">{{ $fatura->consumidor->nome }}</h3>
                            <p class="muted" style="margin: 4px 0 0;">{{ $fatura->consumidor->numero_medidor }}</p>
                        </div>
                        <span class="badge badge-{{ $fatura->status }}">{{ ucfirst($fatura->status) }}</span>
                    </div>

                    <p style="margin: 0 0 6px;"><strong>Mês/Ano:</strong> {{ $fatura->leitura->mes_ano }}</p>
                    <p style="margin: 0 0 6px;"><strong>Leitura anterior:</strong> {{ number_format($fatura->leitura->leitura_anterior, 3, ',', '.') }} m³</p>
                    <p style="margin: 0 0 6px;"><strong>Leitura atual:</strong> {{ number_format($fatura->leitura->leitura_atual, 3, ',', '.') }} m³</p>
                    <p style="margin: 0 0 6px;"><strong>Consumo:</strong> {{ number_format($fatura->leitura->consumo_m3, 3, ',', '.') }} m³ ({{ number_format($fatura->leitura->consumo_m3 * 1000, 0, ',', '.') }} litros)</p>
                    <p style="margin: 0 0 12px;"><strong>Valor:</strong> <span style="font-size: 1rem; font-weight: 700;">R$ {{ number_format($fatura->valor_total, 2, ',', '.') }}</span></p>

                    <div class="inline-actions">
                        <a href="{{ route('faturas.show', $fatura) }}" class="btn btn-outline">Detalhes</a>
                        @if($fatura->status === 'pendente')
                            <form method="POST" action="{{ route('faturas.pagar', $fatura) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">✅ Marcar como pago</button>
                            </form>
                        @endif
                        <a href="{{ $fatura->link_whatsapp }}" target="_blank" class="btn btn-whatsapp">📱 WhatsApp</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
