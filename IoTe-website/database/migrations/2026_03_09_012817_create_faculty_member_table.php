<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faculty_members', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('name_th');
            $table->string('name_en');
            $table->string('position')->nullable();
            $table->string('role')->default('lecturer');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('research_interests')->nullable();
            $table->text('study_paths')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('office_location')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('is_staff')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculty_members');
    }
};
