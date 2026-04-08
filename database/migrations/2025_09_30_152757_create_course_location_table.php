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
        Schema::create('course_location', function (Blueprint $table) {
            $table->id();

            // Foreign key to courses table (works normally, because courses has 'id')
            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->onDelete('cascade');

            // Foreign key to locations table (use string, because 'locid' is string)
            $table->string('location_id');
            $table->foreign('location_id')
                  ->references('locid')   // connect to 'locid' column in locations
                  ->on('locations')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_location');
    }
};
