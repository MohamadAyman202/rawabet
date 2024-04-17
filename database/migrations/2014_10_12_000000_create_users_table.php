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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role_name')->default('imported');
            $table->string('photo')->nullable();
            $table->string('phone')->unique();
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->foreignId('admin_id')->nullable()->constrained();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
