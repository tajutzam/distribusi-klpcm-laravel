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
        Schema::table('klpcm_detail', function (Blueprint $table) {
            //
            $table->boolean('perawatan_gigi')->nullable();
            $table->boolean('nformed_consent_penting')->nullable();
            $table->boolean('informed_consent_autentikasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klpcm_detail', function (Blueprint $table) {
            //
        });
    }
};
