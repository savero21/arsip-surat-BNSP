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
    Schema::create('letters', function (Blueprint $table) {
        $table->id();
        $table->string('number')->unique();             // Nomor Surat
        $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        $table->string('title');                        // Judul
        $table->timestamp('archived_at');               // Waktu Pengarsipan
        $table->string('file_path');                    // path PDF
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
