<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracaoTaxa;
use Illuminate\Http\Request;

class ConfiguracaoTaxaController extends Controller
{
    public function edit()
    {
        $config = ConfiguracaoTaxa::atual();

        return view('config.edit', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'taxa_fixa' => 'required|numeric|min:0',
            'valor_excedente' => 'required|numeric|min:0',
            'limite_isento' => 'required|integer|min:0',
        ]);

        $config = ConfiguracaoTaxa::atual();
        $config->update($request->only('taxa_fixa', 'valor_excedente', 'limite_isento'));

        return back()->with('success', 'Configuração atualizada com sucesso.');
    }
}
