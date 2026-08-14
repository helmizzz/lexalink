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
        Schema::create('outgoing_mails', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number');
            $table->date('mail_date');
            $table->string('type');
            $table->string('recipient');
            $table->foreignId('client_data_id')->nullable()->constrained('client_data')->nullOnDelete();
            $table->string('case_category')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // PIC
            $table->string('status')->default('Dikirim');
            $table->text('description')->nullable();
            $table->string('document_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_mails');
    }
};
