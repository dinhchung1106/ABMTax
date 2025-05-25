<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, drop the foreign key constraint
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['session_id']);
        });

        // Then, drop and recreate the column in the correct position
        DB::statement('ALTER TABLE lessons DROP COLUMN session_id');
        DB::statement('ALTER TABLE lessons ADD COLUMN session_id BIGINT UNSIGNED NULL AFTER course_id');

        // Finally, add back the foreign key constraint
        Schema::table('lessons', function (Blueprint $table) {
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, drop the foreign key constraint
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['session_id']);
        });

        // Then, drop and recreate the column in its original position
        DB::statement('ALTER TABLE lessons DROP COLUMN session_id');
        DB::statement('ALTER TABLE lessons ADD COLUMN session_id BIGINT UNSIGNED NULL');

        // Finally, add back the foreign key constraint
        Schema::table('lessons', function (Blueprint $table) {
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });
    }
};
