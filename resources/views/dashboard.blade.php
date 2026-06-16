@extends('layouts.app')

@section('topbar-title', 'Dashboard')

@section('content')
<div class="stat-grid">
    <div class="stat-box">
        <h3>Total de consumidores</h3>
        <p>{{ $totalConsumidores }}</p>
    </div>
    <div class="stat-box">
        <h3>Faturas do mês</h3>
        <p>{{ $totalFaturas }}</p>
    </div>
    <div class="stat-box">
        <h3>Pendentes</h3>
        <p>{{ $pendentes }}</p>
    </div>
    <div class="stat-box">
        <h3>Receita paga</h3>
        <p>R$ {{ number_format($receitaPaga, 2, ',', '.') }}</p>
    </div>
</div>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h2 style="margin:0;">Últimas faturas do mês</h2>
        <div class="inline-actions">
            <a href="{{ route('consumidores.create') }}" class="btn btn-primary">+ Novo consumidor</a>
            <a href="{{ route('leituras.create') }}" class="btn btn-outline">📊 Registrar leitura</a>
        </div>
    </div>

    @if($ultimasFaturas->isEmpty())
        <p class="muted">Nenhuma fatura encontrada para este mês.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Consumidor</th>
                    <th>Medidor</th>
                    <th>Mês/Ano</th>
                    <th>Valor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ultimasFaturas as $fatura)
                <tr>
                    <td>{{ $fatura->consumidor->nome }}</td>
                    <td>{{ $fatura->consumidor->numero_medidor }}</td>
                    <td>{{ $fatura->leitura->mes_ano }}</td>
                    <td>R$ {{ number_format($fatura->valor_total, 2, ',', '.') }}</td>
                    <td>
                        <span class="badge badge-{{ $fatura->status }}">{{ ucfirst($fatura->status) }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
