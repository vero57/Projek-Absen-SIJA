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
        Schema::create('wa_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('walas_id')->constrained('users');
            $table->time('daily_time')->nullable();
            $table->time('weekly_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wa_settings');
    }
};
