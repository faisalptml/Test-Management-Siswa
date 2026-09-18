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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lembaga_id')
                ->constrained('lembagas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('nis', 20)->unique();

            $table->string('nama_siswa', 150);

            $table->string('email', 150);

            $table->string('foto', 255)->nullable();

            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();

            $table->date('tanggal_lahir')->nullable();

            $table->string('alamat', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
