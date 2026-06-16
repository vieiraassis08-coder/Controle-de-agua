<?php

namespace App\Http\Controllers;

use App\Models\Consumidor;
use App\Models\ConfiguracaoTaxa;
use App\Models\Fatura;
use App\Models\Leitura;
use Illuminate\Http\Request;

class LeituraController extends Controller
{
    public function create()
    {
        $consumidores = Consumidor::orderBy('nome')->get();

        return view('leituras.create', compact('consumidores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'consumidor_id' => 'required|exists:consumidores,id',
            'mes_referencia' => 'required|integer|between:1,12',
            'ano_referencia' => 'required|integer|min:2000|max:2100',
            'leitura_atual' => 'required|numeric|min:0',
        ]);

        $consumidor = Consumidor::findOrFail($request->consumidor_id);

        $jaExiste = Leitura::where('consumidor_id', $consumidor->id)
            ->where('mes_referencia', $request->mes_referencia)
            ->where('ano_referencia', $request->ano_referencia)
            ->exists();

        if ($jaExiste) {
            return back()
                ->withErrors([
                    'mes_referencia' => 'Já existe uma leitura registrada para esse consumidor nesse mês/ano.'
                ])
                ->withInput();
        }

        $ultimaLeitura = Leitura::where('consumidor_id', $consumidor->id)
            ->orderByDesc('ano_referencia')
            ->orderByDesc('mes_referencia')
            ->first();

        $leituraAnterior = $ultimaLeitura ? (float) $ultimaLeitura->leitura_atual : 0;

        if ((float) $request->leitura_atual < $leituraAnterior) {
            return back()
                ->withErrors([
                    'leitura_atual' => 'A leitura atual não pode ser menor que a leitura anterior.'
                ])
                ->withInput();
        }

        $leitura = Leitura::create([
            'consumidor_id' => $consumidor->id,
            'mes_referencia' => (int) $request->mes_referencia,
            'ano_referencia' => (int) $request->ano_referencia,
            'leitura_anterior' => $leituraAnterior,
            'leitura_atual' => (float) $request->leitura_atual,
        ]);

        $consumoM3 = (float) $leitura->leitura_atual - $leituraAnterior;
        $leitura->update(['consumo_m3' => $consumoM3]);

        $config = ConfiguracaoTaxa::atual();
        $valor = round($config->calcularFatura($consumoM3), 2);

        $fatura = Fatura::create([
            'leitura_id' => $leitura->id,
            'consumidor_id' => $consumidor->id,
            'valor_total' => $valor,
            'status' => 'pendente'
        ]);

        return redirect()->route('faturas.show', $fatura)
            ->with('success', 'Leitura registrada com sucesso.');
    }
}
