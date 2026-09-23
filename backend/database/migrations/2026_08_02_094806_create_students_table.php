<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('nis')->unique();
            $table->string('full_name');
            $table->string('nickname')->nullable();

            $table->enum('gender', ['L', 'P']);

            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();

            $table->text('address')->nullable();
            $table->string('phone')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};