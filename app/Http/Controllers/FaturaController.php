<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracaoTaxa;
use App\Models\Fatura;
use Illuminate\Http\Request;

class FaturaController extends Controller
{
    public function index(Request $request)
    {
        $mes = (int) $request->get('mes', now()->month);
        $ano = (int) $request->get('ano', now()->year);

        $faturas = Fatura::with(['consumidor', 'leitura'])
            ->whereHas('leitura', function ($query) use ($mes, $ano) {
                $query->where('mes_referencia', $mes)
                    ->where('ano_referencia', $ano);
            })
            ->orderByDesc('created_at')
            ->get();

        return view('faturas.index', compact('faturas', 'mes', 'ano'));
    }

    public function show(Fatura $fatura)
    {
        $fatura->load(['consumidor', 'leitura']);

        $config = ConfiguracaoTaxa::atual();
        $consumo = (float) $fatura->leitura->consumo_m3;
        $taxaFixa = (float) $config->taxa_fixa;
        $excedente = max(0, $consumo - $config->limite_isento / 1000);
        $valorExcedente = $excedente > 0 ? $excedente * (float) $config->valor_excedente : 0;
        $total = round($taxaFixa + $valorExcedente, 2);

        return view('faturas.show', compact('fatura', 'config', 'consumo', 'taxaFixa', 'excedente', 'valorExcedente', 'total'));
    }

    public function pagar(Fatura $fatura)
    {
        $fatura->update(['status' => 'pago']);

        return back()->with('success', 'Fatura marcada como paga.');
    }
}
