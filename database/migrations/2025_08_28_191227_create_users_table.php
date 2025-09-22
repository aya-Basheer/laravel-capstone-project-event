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
            $table->string('name', 120);
            $table->string('email', 190)->unique()->nullable();
            $table->string('phone', 32)->unique()->nullable();
            $table->string('password_hash', 255);

            // المفتاح الأجنبي مضبوط مع roles.id (BIGINT UNSIGNED)
            $table->foreignId('role_id')
                ->constrained('roles')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
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
