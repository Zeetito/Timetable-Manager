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
        Schema::create('course_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('user_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            //assessment and mid-sem
            $table->double('midsem_score', 5, 2)->nullable();
            $table->double('assessment_score', 5, 2)->nullable();
            $table->double('exam_score', 5, 2)->nullable();
            $table->double('total_score', 5, 2)->nullable();

            $table->foreignId('semester_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_users');
    }
};
