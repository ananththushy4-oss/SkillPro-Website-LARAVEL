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
        Schema::create('course_category', function (Blueprint $table) {
            $table->id();

            // Foreign key to courses table (normal, since courses has id)
            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->onDelete('cascade');

            // Foreign key to categories table (string, since categories uses catid)
            $table->string('category_id');
            $table->foreign('category_id')
                  ->references('catid')   // points to 'catid' in categories
                  ->on('categories')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_category');
    }
};
