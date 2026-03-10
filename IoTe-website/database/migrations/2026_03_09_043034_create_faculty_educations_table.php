<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faculty_education', function (Blueprint $table) {
            $table->id();

            $table->foreignId('faculty_member_id')
                ->constrained('faculty_members')
                ->onDelete('cascade');

            $table->string('degree', 100)->nullable();
            $table->string('field', 255)->nullable();
            $table->string('university', 255)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('year', 10)->nullable();

            $table->unsignedInteger('sort_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculty_educations');
    }
};
