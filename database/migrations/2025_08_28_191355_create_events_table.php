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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 180);
            $table->text('description')->nullable();
            $table->enum('type', ['conference', 'workshop', 'webinar', 'meetup']);
            $table->unsignedInteger('location_id');
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->integer('capacity')->nullable();
            $table->integer('audience_mask')->default(0)->comment('bitmask للجمهور: 1=students,2=professionals,4=general,8=vip');
            $table->boolean('is_featured')->default(false);
            $table->dateTime('registration_deadline')->nullable();
            $table->text('requirements')->nullable();
            $table->text('agenda')->nullable();
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->index(['location_id', 'starts_at', 'ends_at'], 'idx_events_loc_time');
            $table->index('starts_at');
            $table->index('ends_at');
            $table->index('organizer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
