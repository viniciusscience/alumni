<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('egressos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->unique()->constrained()->nullOnDelete();
            $table->string('public_token', 120)->unique();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('telefone', 30);
            $table->string('curso');
            $table->unsignedSmallInteger('ano_conclusao');
            $table->string('cidade')->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('linkedin')->nullable();
            $table->string('empresa_atual')->nullable();
            $table->string('cnpj_empresa', 20)->nullable();
            $table->string('cargo_atual')->nullable();
            $table->string('area_atuacao')->nullable();
            $table->string('regime_trabalho', 100)->nullable();
            $table->date('data_inicio_emprego')->nullable();
            $table->string('status_profissional', 100)->nullable();
            $table->string('interesse_vagas', 50)->nullable();
            $table->string('interesse_mentoria', 50)->nullable();
            $table->boolean('consentimento_contato')->default(false);
            $table->timestamps();

            $table->index(['curso', 'ano_conclusao']);
            $table->index(['status_profissional', 'empresa_atual']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egressos');
    }
};
