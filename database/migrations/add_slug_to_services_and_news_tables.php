<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('services', 'slug')) {
            Schema::table('services', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
            });
        }
        if (!Schema::hasColumn('news', 'slug')) {
            Schema::table('news', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('services', 'slug')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
        if (Schema::hasColumn('news', 'slug')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
}; 