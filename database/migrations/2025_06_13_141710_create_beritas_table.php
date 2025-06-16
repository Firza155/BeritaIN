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
        if (!Schema::hasTable('beritas')) {
            Schema::create('beritas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('kategori_id');
                $table->string('judul');
                $table->string('slug')->unique();
                $table->text('isi');
                $table->string('gambar')->nullable();
                $table->enum('status', ['draft', 'pending', 'published', 'rejected'])->default('draft');
                $table->text('keterangan_ditolak')->nullable();
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
                $table->softDeletes();

                // Tambahkan index untuk foreign key
                $table->index('user_id');
                $table->index('kategori_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
