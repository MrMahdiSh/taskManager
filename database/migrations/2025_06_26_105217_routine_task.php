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
        Schema::create('routine_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_id');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
            $table->unsignedBigInteger('routine_id');
            $table->foreign('routine_id')->references('id')->on('routines')->onDelete('cascade');
            $table->string('status');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routine_tasks');
    }
};
