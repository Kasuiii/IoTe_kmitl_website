<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->string('courseID', 20)->primary();
            $table->integer('courseYear');
            $table->string('courseName', 255);
            $table->integer('courseCredit');
            $table->string('courseType', 50);
            $table->text('courseDescript')->nullable();
            $table->integer('courseSemester');
            $table->string('courseDegree', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('course');
    }
};
