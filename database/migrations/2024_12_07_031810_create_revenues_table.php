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
    Schema::create('revenues', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('professional_id');
        $table->decimal('total_revenue', 10, 2);
        $table->decimal('admin_deduction', 10, 2);
        $table->decimal('net_revenue', 10, 2);
        $table->date('month');
        $table->timestamps();

        $table->foreign('professional_id')->references('id')->on('professionalinfo')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
