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
        Schema::create('professionalinfo', function (Blueprint $table) {
            $table->id();
            $table->date('birthday');
            $table->integer('age');
            $table->text('certifications'); // Text area for certifications
            $table->integer('experience'); // Number of years of experience
            $table->text('specializations'); // Text area for specializations
            $table->text('bio'); // Professional bio
            $table->text('programs'); // Fitness programs offered
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionalinfo');
    }
};
