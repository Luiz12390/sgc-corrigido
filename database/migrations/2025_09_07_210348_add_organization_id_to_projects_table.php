<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Adiciona a coluna que vai ligar o projeto a uma organização
            $table->foreignId('organization_id')
                  ->nullable() // Permite que projetos existam sem uma organização
                  ->after('id') // Opcional: Coloca a coluna logo após o ID
                  ->constrained('organizations') // Cria a chave estrangeira para a tabela 'organizations'
                  ->onDelete('cascade'); // Se a organização for apagada, os seus projetos também serão
        });
    }

    // O método down() já deve estar correto para reverter a alteração
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
        });
    }
};
