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
        Schema::create('event_speakers', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('speaker_id');

            $table->primary(['event_id', 'speaker_id']);

            $table->foreign('event_id')->references('id')->on('events')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('speaker_id')->references('id')->on('speakers')
                  ->onUpdate('cascade')->onDelete('cascade');

            $table->index('speaker_id', 'idx_es_speaker');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_speakers');
    }
};
