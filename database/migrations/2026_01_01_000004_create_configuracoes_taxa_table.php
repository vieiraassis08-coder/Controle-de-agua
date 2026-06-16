<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracoes_taxa', function (Blueprint $table) {
            $table->id();
            $table->decimal('taxa_fixa', 8, 2)->default(25.00);
            $table->decimal('valor_excedente', 8, 2)->default(2.00);
            $table->integer('limite_isento')->default(10000);
            $table->timestamps();
        });

        DB::table('configuracoes_taxa')->insert([
            'taxa_fixa' => 25.00,
            'valor_excedente' => 2.00,
            'limite_isento' => 10000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracoes_taxa');
    }
};
