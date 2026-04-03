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
        Schema::table('instructors', function (Blueprint $table) {
            // Only add user_id if it does not already exist
            if (!Schema::hasColumn('instructors', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id')->unique();
                $table->foreign('user_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructors', function (Blueprint $table) {
            if (Schema::hasColumn('instructors', 'user_id')) {
                // Drop the foreign key first
                $table->dropForeign(['user_id']);

                // Then drop the column
                $table->dropColumn('user_id');
            }
        });
    }
};
