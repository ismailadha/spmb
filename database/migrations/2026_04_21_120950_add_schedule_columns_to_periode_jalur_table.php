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
        Schema::table('periode_jalur', function (Blueprint $table) {
            $table->date('pendaftaran_mulai')->nullable()->after('jalur_id');
            $table->date('pendaftaran_selesai')->nullable()->after('pendaftaran_mulai');
            $table->date('verifikasi_mulai')->nullable()->after('pendaftaran_selesai');
            $table->date('verifikasi_selesai')->nullable()->after('verifikasi_mulai');
            $table->date('daftar_ulang_mulai')->nullable()->after('verifikasi_selesai');
            $table->date('daftar_ulang_selesai')->nullable()->after('daftar_ulang_mulai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('periode_jalur', function (Blueprint $table) {
            $table->dropColumn([
                'pendaftaran_mulai',
                'pendaftaran_selesai',
                'verifikasi_mulai',
                'verifikasi_selesai',
                'daftar_ulang_mulai',
                'daftar_ulang_selesai',
            ]);
        });
    }
};
