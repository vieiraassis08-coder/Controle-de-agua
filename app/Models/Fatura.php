<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $table = 'faturas';

    protected $fillable = [
        'leitura_id',
        'consumidor_id',
        'valor_total',
        'status',
    ];

    protected $appends = ['link_whatsapp'];

    public function consumidor()
    {
        return $this->belongsTo(Consumidor::class);
    }

    public function leitura()
    {
        return $this->belongsTo(Leitura::class);
    }

    public function getLinkWhatsappAttribute(): string
    {
        $telefone = preg_replace('/\D/', '', $this->consumidor->telefone ?? '');

        $mensagem = sprintf(
            "Olá, %s! Segue o consumo de %s:\nMedidor: %s\nLeitura anterior: %.3f m³ → Leitura atual: %.3f m³\nConsumo: %.3f m³ (%.0f litros)\nValor da fatura: R$ %.2f\nAtt, Associação Comunitária",
            $this->consumidor->nome,
            $this->leitura->mes_ano,
            $this->consumidor->numero_medidor,
            $this->leitura->leitura_anterior,
            $this->leitura->leitura_atual,
            $this->leitura->consumo_m3,
            $this->leitura->consumo_m3 * 1000,
            $this->valor_total
        );

        return 'https://wa.me/55' . $telefone . '?text=' . urlencode($mensagem);
    }
}
