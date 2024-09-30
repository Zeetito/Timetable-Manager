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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('code')->unique();
            $table->string('code');
            
            $table->integer('credit_hour')->nullable();

            $table->foreignId('department_id')->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('set null');

            $table->text('lecturers_id')->nullable();
            $table->timestamps();

        });

        // Check out for IDL courses
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
