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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('company_name');
            $table->string('position');
            $table->string('offer_url', 2048)->nullable();
            $table->enum('status', [
                'wishlist',
                'applied',
                'interview',
                'offer',
                'rejected',
                'accepted',
            ])->default('wishlist');
            $table->enum('priority', [
                'low',
                'medium',
                'high',
            ])->default('medium');
            $table->text('notes')->nullable();
            $table->date('applied_at');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};