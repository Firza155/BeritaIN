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
        // Pastikan tabel kategoris dan users ada terlebih dahulu
        if (Schema::hasTable('kategoris') && Schema::hasTable('users') && Schema::hasTable('beritas')) {
            // Tambahkan foreign key untuk user_id
            if (Schema::hasColumn('beritas', 'user_id')) {
                try {
                    Schema::table('beritas', function (Blueprint $table) {
                        $table->foreign('user_id')
                            ->references('id')
                            ->on('users')
                            ->onDelete('cascade');
                    });
                } catch (\Exception $e) {
                    // Skip error jika foreign key sudah ada
                    if (!str_contains($e->getMessage(), 'Duplicate foreign key constraint')) {
                        throw $e;
                    }
                }
            }

            // Tambahkan foreign key untuk kategori_id
            if (Schema::hasColumn('beritas', 'kategori_id')) {
                try {
                    Schema::table('beritas', function (Blueprint $table) {
                        $table->foreign('kategori_id')
                            ->references('id')
                            ->on('kategoris')
                            ->onDelete('cascade');
                    });
                } catch (\Exception $e) {
                    // Skip error jika foreign key sudah ada
                    if (!str_contains($e->getMessage(), 'Duplicate foreign key constraint')) {
                        throw $e;
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['kategori_id']);
        });
    }
};
