<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('type')->nullable();
            $table->string('file_path', 2048)->nullable();
            $table->string('cover_image_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('resources'); }
};
