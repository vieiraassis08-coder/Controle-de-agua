<?php

namespace App\Http\Controllers;

use App\Models\Consumidor;
use App\Models\Fatura;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mes = now()->month;
        $ano = now()->year;

        $totalConsumidores = Consumidor::count();

        $faturasDoMes = Fatura::with(['consumidor', 'leitura'])
            ->whereHas('leitura', function ($query) use ($mes, $ano) {
                $query->where('mes_referencia', $mes)
                    ->where('ano_referencia', $ano);
            });

        $totalFaturas = (clone $faturasDoMes)->count();
        $pendentes = (clone $faturasDoMes)->where('status', 'pendente')->count();
        $receitaPaga = (clone $faturasDoMes)->where('status', 'pago')->sum('valor_total');

        $ultimasFaturas = (clone $faturasDoMes)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalConsumidores',
            'totalFaturas',
            'pendentes',
            'receitaPaga',
            'ultimasFaturas'
        ));
    }
}
