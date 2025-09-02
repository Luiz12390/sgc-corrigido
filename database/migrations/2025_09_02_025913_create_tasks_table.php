<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default('Não Iniciado');
            $table->date('due_date')->nullable();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Responsável
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('tasks'); }
};
