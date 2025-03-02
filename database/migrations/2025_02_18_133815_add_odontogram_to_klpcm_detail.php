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
            $table->boolean('odontogram')->default(false);
            $table->boolean('pemeriksaan_fisik')->default(false);
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
