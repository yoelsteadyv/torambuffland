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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('secondLevelId')->nullable(); // Menambahkan kolom secondLevel
            $table->integer('secondBuffId')->nullable(); // Menambahkan kolom secondBuff
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['secondLevelId', 'secondBuffId']); // Menghapus kolom jika migrasi dibatalkan
        });
    }
};
