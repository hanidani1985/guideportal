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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Tour guide who created
            $table->string('name');
            $table->text('short_description');
            $table->longText('long_description');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->decimal('entry_price', 10, 2)->nullable();
            $table->string('currency')->default('USD');
            $table->string('best_time_year')->nullable(); // e.g., "March-September"
            $table->string('best_hours')->nullable(); // e.g., "6AM-10AM"
            $table->string('best_tide_level')->nullable(); // e.g., "Low tide", "High tide"
            $table->json('suitable_vehicles')->nullable(); // ['bike', 'car', 'offroader']
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
