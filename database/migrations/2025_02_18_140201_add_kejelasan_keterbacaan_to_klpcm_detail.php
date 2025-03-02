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
            $table->boolean('kejelasan')->default(false);
            $table->boolean('keterbacaan')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klpcm_detail', function (Blueprint $table) {
            //
            $table->dropColumn('kejelasan');
            $table->dropColumn('keterbacaan');
        });
    }
};
