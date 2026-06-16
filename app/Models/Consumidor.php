<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumidor extends Model
{
    protected $table = 'consumidores';

    protected $fillable = [
        'nome',
        'endereco',
        'numero_medidor',
        'telefone',
    ];

    public function leituras()
    {
        return $this->hasMany(Leitura::class);
    }

    public function faturas()
    {
        return $this->hasMany(Fatura::class);
    }

    public function ultimaLeitura()
    {
        return $this->hasOne(Leitura::class)->orderByDesc('ano_referencia')->orderByDesc('mes_referencia');
    }
}
