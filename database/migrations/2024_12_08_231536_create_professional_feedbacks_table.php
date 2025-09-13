<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('professional_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');          // User giving feedback
            $table->unsignedBigInteger('professional_id');  // Professional receiving feedback
            $table->tinyInteger('score')->default(0);       // Score (1-5)
            $table->text('feedback');                       // Feedback comment
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('professional_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_feedbacks');
    }
};
