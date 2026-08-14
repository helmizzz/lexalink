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
        Schema::create('client_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Perorangan', 'Perusahaan', 'Institusi']);
            $table->string('contact_person')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('case_category')->nullable();
            $table->enum('status', ['Aktif', 'Non-Aktif', 'Selesai'])->default('Aktif');
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_data');
    }
};
