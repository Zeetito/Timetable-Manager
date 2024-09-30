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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();

            $table->foreignId('department_id')->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                    
            $table->string('floor')->nullable();
            $table->string('type')->nullable();
            $table->integer('exams_cap')->nullable();
            $table->integer('reg_cap')->nullable();
            $table->integer('max_cap')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
