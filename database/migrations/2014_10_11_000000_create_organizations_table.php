<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('logo_path', 2048)->nullable();
            $table->string('type')->nullable();
            $table->string('specialization_areas')->nullable();
            $table->string('competencies')->nullable();
            $table->string('available_resources')->nullable();

            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('organizations'); }
};
