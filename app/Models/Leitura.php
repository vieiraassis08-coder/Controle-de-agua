<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
    protected $table = 'leituras';

    protected $fillable = [
        'consumidor_id',
        'mes_referencia',
        'ano_referencia',
        'leitura_anterior',
        'leitura_atual',
        'consumo_m3',
    ];

    protected $appends = ['mes_ano'];

    public function consumidor()
    {
        return $this->belongsTo(Consumidor::class);
    }

    public function fatura()
    {
        return $this->hasOne(Fatura::class);
    }

    public function getMesAnoAttribute(): string
    {
        $meses = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];

        return ($meses[$this->mes_referencia] ?? 'Mês') . '/' . $this->ano_referencia;
    }
}
