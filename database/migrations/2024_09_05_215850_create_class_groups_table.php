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
        Schema::create('class_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('year');

            $table->boolean('is_divided')->default(0);
                    
            $table->date('start_year');
            $table->date('end_year');
            $table->timestamps();

            // $table->primary(['program_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_groups');
    }
};
