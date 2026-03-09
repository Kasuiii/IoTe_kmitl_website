<?php
// RESERVABLE ITEMS = equipment the dept owns (ESP32, oscilloscopes, lab coats etc.)
// RESERVATIONS = a student's request to borrow an item
//
// LOGIC:
// - Each item has a "faculty_access" field: 'engineering', 'science', or 'all'
// - Engineering students (email: 67 01 xxxx) can only see engineering items
// - Science students   (email: 67 05 xxxx) can only see science items
// - Items with 'all' are visible to everyone
// - "quantity_total" = how many units we own
// - "quantity_available" = computed: total minus currently active loans

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faculty_educations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('faculty_member_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('degree');      // BSc / MSc / PhD
            $table->string('field')->nullable(); // Computer Science
            $table->string('university');
            $table->string('country')->nullable();
            $table->string('year')->nullable();

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculty_educations');
    }
};
