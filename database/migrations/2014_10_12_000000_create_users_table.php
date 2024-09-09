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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('firstname');
            $table->string('othername')->nullable();
            $table->string('lastname');
            $table->char('gender');
            $table->string('identity_number')->nullable()->unique();
            $table->string('index_number')->nullable()->unique();
            $table->boolean('is_staff');
            $table->foreignId('program_id')->nullable();
            $table->foreignId('class_group_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // $table->primary(['identity_number', 'product_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
