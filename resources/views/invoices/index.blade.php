@extends('layouts.app')

@section('content')
<div class="card">
    <h1>🧾 Faturas</h1>

    {{-- Filtro de mês/ano --}}
    <form method="GET" action="{{ route('faturas.index') }}" style="display:flex; gap:12px; margin-bottom:20px; flex-wrap:wrap; align-items:flex-end;">
        <div>
            <label>Mês</label>
            <select name="mes">
                @foreach(range(1,12) as $m)
                    <option value="{{ $m }}" {{ $mes == $m ? 'selected' : '' }}>
                        {{ str_pad($m, 2, '0', STR_PAD_LEFT) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Ano</label>
            <input type="number" name="ano" value="{{ $ano }}" min="2000" max="2100" style="width:100px;">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-bottom:14px;">🔍 Filtrar</button>
    </form>

    @if($faturas->isEmpty())
        <p style="color:#888; text-align:center; padding:24px 0;">Nenhuma fatura encontrada para {{ str_pad($mes,2,'0',STR_PAD_LEFT) }}/{{ $ano }}.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Consumidor</th>
                    <th>Mês/Ano</th>
                    <th>Consumo (m³)</th>
                    <th>Valor (R$)</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faturas as $f)
                <tr>
                    <td>{{ $f->consumidor->nome }}</td>
                    <td>{{ str_pad($f->leitura->mes_referencia,2,'0',STR_PAD_LEFT) }}/{{ $f->leitura->ano_referencia }}</td>
                    <td>{{ number_format($f->leitura->consumo_m3, 3, ',', '.') }}</td>
                    <td><strong>R$ {{ number_format($f->valor_total, 2, ',', '.') }}</strong></td>
                    <td><span class="badge badge-{{ $f->status }}">{{ ucfirst($f->status) }}</span></td>
                    <td style="display:flex; gap:8px; flex-wrap:wrap;">
                        @if($f->status === 'pendente')
                            <form method="POST" action="{{ route('faturas.pagar', $f) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">✅ Pago</button>
                            </form>
                        @endif

                        {{-- Botão WhatsApp (Bônus) --}}
                        @php
                            $telefone = preg_replace('/\D/', '', $f->consumidor->telefone);
                            $meses = ['','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
                            $mesNome = $meses[$f->leitura->mes_referencia] ?? $f->leitura->mes_referencia;
                            $msg = "Olá, {$f->consumidor->nome}! Segue o consumo de {$mesNome}/{$f->leitura->ano_referencia}:\n\n"
                                 . "Medidor: {$f->consumidor->numero_medidor}\n"
                                 . "Leitura anterior: {$f->leitura->leitura_anterior} m³  →  Leitura atual: {$f->leitura->leitura_atual} m³\n"
                                 . "Consumo: {$f->leitura->consumo_m3} m³ (" . ($f->leitura->consumo_m3 * 1000) . " litros)\n"
                                 . "Valor da fatura: R$ " . number_format($f->valor_total, 2, ',', '.') . "\n\n"
                                 . "Att, Associação Comunitária";
                            $link = "https://wa.me/55{$telefone}?text=" . urlencode($msg);
                        @endphp
                        <a href="{{ $link }}" target="_blank" class="btn btn-whatsapp btn-sm">📱 WhatsApp</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
