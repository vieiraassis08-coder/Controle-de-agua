<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracaoTaxa extends Model
{
    protected $table = 'configuracoes_taxa';

    protected $fillable = [
        'taxa_fixa',
        'valor_excedente',
        'limite_isento',
    ];

    public static function atual(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'taxa_fixa' => 25.00,
                'valor_excedente' => 2.00,
                'limite_isento' => 10000,
            ]
        );
    }

    public function calcularFatura(float $consumoM3): float
    {
        $limiteM3 = (int) $this->limite_isento / 1000;

        if ($consumoM3 <= $limiteM3) {
            return (float) $this->taxa_fixa;
        }

        $excedenteM3 = $consumoM3 - $limiteM3;
        $valorExcedente = $excedenteM3 * (float) $this->valor_excedente;

        return (float) $this->taxa_fixa + $valorExcedente;
    }
}
