<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('time_lines', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('goal');
            $table->enum('status', ['planned', 'done']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('time_lines');
    }
};
