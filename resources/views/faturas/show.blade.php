@extends('layouts.app')

@section('topbar-title', 'Detalhes da fatura')

@section('content')
<div class="card" style="max-width: 720px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap: 10px; margin-bottom: 18px;">
        <div>
            <h1 style="margin: 0;">🧾 Fatura de {{ $fatura->consumidor->nome }}</h1>
            <p class="muted" style="margin: 6px 0 0;">{{ $fatura->leitura->mes_ano }}</p>
        </div>
        <span class="badge badge-{{ $fatura->status }}">{{ ucfirst($fatura->status) }}</span>
    </div>

    <div class="grid-2">
        <div>
            <p style="margin: 0 0 6px;"><strong>Medidor:</strong> {{ $fatura->consumidor->numero_medidor }}</p>
            <p style="margin: 0 0 6px;"><strong>Endereço:</strong> {{ $fatura->consumidor->endereco }}</p>
            <p style="margin: 0 0 6px;"><strong>Leitura anterior:</strong> {{ number_format($fatura->leitura->leitura_anterior, 3, ',', '.') }} m³</p>
            <p style="margin: 0 0 6px;"><strong>Leitura atual:</strong> {{ number_format($fatura->leitura->leitura_atual, 3, ',', '.') }} m³</p>
        </div>
        <div>
            <p style="margin: 0 0 6px;"><strong>Consumo:</strong> {{ number_format($fatura->leitura->consumo_m3, 3, ',', '.') }} m³</p>
            <p style="margin: 0 0 6px;"><strong>Litros:</strong> {{ number_format($fatura->leitura->consumo_m3 * 1000, 0, ',', '.') }} L</p>
            <p style="margin: 0 0 6px;"><strong>Valor total:</strong> R$ {{ number_format($fatura->valor_total, 2, ',', '.') }}</p>
        </div>
    </div>

    <div class="card" style="padding: 16px; margin-top: 18px; border: 1px solid var(--border); box-shadow: none;">
        <h3 style="margin-top: 0;">Detalhamento</h3>
        <p style="margin: 8px 0;">Taxa fixa: R$ {{ number_format($taxaFixa, 2, ',', '.') }}</p>
        <p style="margin: 8px 0;">Excedente: {{ number_format($excedente, 3, ',', '.') }} m³</p>
        <p style="margin: 8px 0;">Valor do excedente: R$ {{ number_format($valorExcedente, 2, ',', '.') }}</p>
        <p style="margin: 8px 0;"><strong>Total:</strong> R$ {{ number_format($total, 2, ',', '.') }}</p>
    </div>

    <div class="inline-actions" style="margin-top: 18px;">
        @if($fatura->status === 'pendente')
            <form method="POST" action="{{ route('faturas.pagar', $fatura) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success">✅ Marcar como pago</button>
            </form>
        @endif
        <a href="{{ $fatura->link_whatsapp }}" target="_blank" class="btn btn-whatsapp">📱 Enviar WhatsApp</a>
        <a href="{{ route('faturas.index') }}" class="btn btn-outline">Voltar</a>
    </div>
</div>
@endsection
