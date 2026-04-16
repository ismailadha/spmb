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
            $table->decimal('rata_rapor', 10, 2)->nullable()->after('pendaftaran_id');
            $table->decimal('nilai_tes_akademik', 10, 2)->nullable()->after('rata_rapor');
            $table->decimal('nilai_prestasi', 10, 2)->nullable()->after('nilai_tes_akademik');
            $table->decimal('skor_jarak', 10, 2)->nullable()->after('nilai_prestasi');
            $table->decimal('skor_usia', 10, 2)->nullable()->after('skor_jarak');
            $table->decimal('nilai_akhir', 10, 2)->nullable()->after('skor_usia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_seleksi', function (Blueprint $table) {
            $table->dropColumn(['rata_rapor', 'nilai_tes_akademik', 'nilai_prestasi', 'skor_jarak', 'skor_usia', 'nilai_akhir']);
        });
    }
};
