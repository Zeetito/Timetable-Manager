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
        Schema::create('course_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('stream')->nullable();
            $table->foreignId('room_id')->nullable();
            $table->string('day')->nullable();
            $table->text('class_codes')->nullable();
            $table->foreignId('semester_id');
            $table->timestamps();

            // Add uniuqe constraints
            $table->unique(['start_time', 'room_id', 'day', 'semester_id']);
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_schedules');
    }
};
