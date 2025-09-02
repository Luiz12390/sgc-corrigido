<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // Ex: Artigo, Relatório, Estudo de Caso
            $table->text('description');
            $table->string('cover_image_path', 2048)->nullable();
            $table->string('file_path', 2048)->nullable(); // Caminho para o PDF
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('resources'); }
};
