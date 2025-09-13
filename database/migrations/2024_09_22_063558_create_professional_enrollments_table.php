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
        Schema::create('professional_enrollments', function (Blueprint $table) {
            $table->id('enrollment_id'); // Primary key
            $table->unsignedBigInteger('professional_id'); // Just store the ID, no foreign key
            $table->unsignedBigInteger('user_id'); // Just store the ID, no foreign key
            $table->string('professional_name');
            $table->string('name');
            $table->enum('enrollment_status', ['enrolled', 'unenrolled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_enrollments');
    }
};
