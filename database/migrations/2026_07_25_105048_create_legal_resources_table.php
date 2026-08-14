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
        Schema::create('legal_resources', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->string('document_number', 100);
            $table->string('category', 100); // e.g. 'Undang-Undang', 'Putusan MA', 'Regulasi AI', 'Jurnal Kajian'
            $table->integer('year');
            $table->date('effective_date')->nullable();
            $table->longText('abstract');
            $table->string('file_path', 255)->nullable();
            $table->unsignedInteger('downloads_count')->default(0);
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_resources');
    }
};
