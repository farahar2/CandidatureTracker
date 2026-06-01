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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->enum('type', [
                'phone',
                'video',
                'onsite',
                'technical',
                'hr',
            ]);
            $table->dateTime('scheduled_at');
            $table->text('notes')->nullable();
            $table->enum('result', [
                'pending',
                'passed',
                'failed',
            ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};