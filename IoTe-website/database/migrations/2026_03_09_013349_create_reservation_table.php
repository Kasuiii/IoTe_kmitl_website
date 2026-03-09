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
        Schema::create('reservable_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // "ESP32 DevKit V1"
            $table->string('category');             // "Microcontroller" / "Lab Instrument" etc
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            // 'engineering' = only 01 faculty, 'science' = only 05 faculty, 'all' = everyone
            $table->string('faculty_access')->default('all');
            $table->integer('quantity_total')->default(1);
            $table->integer('quantity_available')->default(1); // admin manages manually too
            $table->integer('max_borrow_days')->default(7);    // max loan duration
            $table->boolean('is_active')->default(true);       // hide item without deleting
            $table->timestamps();
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('reservable_item_id')->constrained()->onDelete('cascade');
            $table->integer('quantity_requested')->default(1);
            $table->date('borrow_date');            // when they want to pick it up
            $table->date('return_date');            // when they promise to return it
            $table->date('actual_return_date')->nullable(); // filled in by admin when returned
            // Status flow: pending → approved → borrowed → returned (or rejected/cancelled)
            $table->string('status')->default('pending');
            $table->text('purpose')->nullable();    // why they need it
            $table->text('admin_notes')->nullable(); // admin can write notes
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('reservable_items');
    }
};
