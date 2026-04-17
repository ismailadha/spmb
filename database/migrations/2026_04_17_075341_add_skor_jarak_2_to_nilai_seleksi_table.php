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
        Schema::table('nilai_seleksi', function (Blueprint $table) {
            $table->integer('skor_jarak_2')->nullable()->after('skor_jarak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_seleksi', function (Blueprint $table) {
            $table->dropColumn('skor_jarak_2');
        });
    }
};
