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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subscription_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('InvoiceId')->unique();
            $table->string('CustomerName');
            $table->string('CustomerMobile');
            $table->string('CustomerEmail');
            $table->string('InvoiceValue');
            $table->string('InvoiceDisplayValue');
            $table->string('DueDeposit');
            $table->string('TransactionDate');
            $table->string('PaymentGateway');
            $table->string('ReferenceId');
            $table->string('TransactionId');
            $table->string('PaymentId');
            $table->string('TransactionStatus');
            $table->string('TransationValue');
            $table->string('Country');
            $table->string('Currency');
            $table->string('CardNumber');
            $table->boolean('IsSuccess');
            $table->string('Error')->nullable();
            $table->string('ErrorCode')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum('status_work', ['working', 'enddate', 'error'])->default('working');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
