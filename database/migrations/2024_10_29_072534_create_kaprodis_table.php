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
        Schema::create('kaprodis', function (Blueprint $table) {
            $table->id();
            // Foreign key 'user_id' yang terhubung ke 'users' dan akan otomatis menghapus jika user terkait dihapus.
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('kode_kaprodi')->unique();
            $table->integer('nip')->unique();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaprodis');
    }
};
