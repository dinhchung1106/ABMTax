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
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('title')->after('id');
        });

        DB::statement('UPDATE lessons SET title = name');
        
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('name')->after('id');
        });

        DB::statement('UPDATE lessons SET name = title');
        
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
}; 