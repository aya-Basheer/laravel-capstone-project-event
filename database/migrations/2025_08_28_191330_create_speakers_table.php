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
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->text('bio');
            $table->string('email', 190)->nullable()->unique();
            $table->string('phone', 32)->nullable();
            $table->string('company', 255)->nullable();
            $table->string('position', 255)->nullable();
            $table->json('topics_json')->nullable();
            $table->string('avatar_url', 255)->nullable();
            $table->string('linkedin_url', 500)->nullable();
            $table->string('twitter_url', 500)->nullable();
            $table->string('website_url', 500)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
