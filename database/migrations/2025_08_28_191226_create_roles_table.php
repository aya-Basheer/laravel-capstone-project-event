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
        Schema::create('roles', function (Blueprint $table) {
            // مفتاح أساسي تلقائي (BIGINT UNSIGNED) أفضل من tinyIncrements لضمان التوافق مع FK في users
            $table->id();

            // اسم الدور (organizer / audience) مع قيد uniqueness
            $table->string('name', 32)->unique()
                ->comment('اسم الدور: organizer / audience');

            $table->timestamps(); // لتتبع الإنشاء والتعديل
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
