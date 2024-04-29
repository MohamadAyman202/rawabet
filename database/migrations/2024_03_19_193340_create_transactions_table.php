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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('InvoiceId')->unique();
            $table->string('InvoiceURL');
            $table->string('CustomerReference')->nullable();
            $table->string('UserDefinedField')->nullable();
            $table->string('Message')->nullable();
            $table->string('ValidationErrors')->nullable();
            $table->string('IsSuccess')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
