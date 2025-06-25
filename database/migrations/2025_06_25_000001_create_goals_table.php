<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Untitled Goal'); // Added default value for title
            $table->text('description')->nullable();
            $table->string('status')->default('planned'); // Added default value for status
            $table->date('deadline')->nullable();
            $table->integer('priority')->default(1); // Added default value for priority
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('goals');
    }
}