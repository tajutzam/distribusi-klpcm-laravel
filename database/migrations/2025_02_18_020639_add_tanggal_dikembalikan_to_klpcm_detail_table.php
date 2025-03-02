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
            $table->date('tanggal_dikembalikan')->nullable()->after('status_kembali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klpcm_detail', function (Blueprint $table) {
            //
            $table->dropColumn('tanggal_dikembalikan');

        });
    }
};
