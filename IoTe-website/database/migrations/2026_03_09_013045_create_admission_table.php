<?php
// WHY TWO TABLES?
// admission_rounds = the "container" (e.g. "รอบที่ 1 Portfolio")
// admission_projects = the actual projects INSIDE each round (e.g. "Young Engineering Talent")
// This is called a "one-to-many" relationship:
//   one round → many projects

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Parent table
        Schema::create('admission_rounds', function (Blueprint $table) {
            $table->id();
            $table->integer('round_number');
            $table->string('round_name');
            $table->string('round_name_th');
            $table->integer('total_seats');
            $table->string('badge_color')->default('crimson');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Child table
        Schema::create('admission_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admission_round_id')->constrained()->onDelete('cascade');
            $table->string('project_name');
            $table->string('project_name_th');
            $table->integer('seats');
            $table->text('requirements')->nullable();
            $table->text('score_criteria')->nullable();
            $table->string('gpax_min')->nullable();
            $table->text('notes')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_projects');
        Schema::dropIfExists('admission_rounds');
    }
};
