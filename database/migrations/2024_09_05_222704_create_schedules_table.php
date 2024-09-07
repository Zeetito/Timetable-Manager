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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->morphs('scheduleable');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->double('duration',2,1)->nullable();
            $table->foreignId('room_id')->nullable();
            $table->foreignId('lecturer_id')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('semester_id');
            $table->timestamps();

            $table->foreign('lecturer_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
