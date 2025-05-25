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
        // Use raw SQL to rename the column for better compatibility
        DB::statement('ALTER TABLE `news` CHANGE `category` `category_id` VARCHAR(255) NULL DEFAULT NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Use raw SQL to revert the column name
        DB::statement('ALTER TABLE `news` CHANGE `category_id` `category` VARCHAR(255) NULL DEFAULT NULL;');
    }
};
