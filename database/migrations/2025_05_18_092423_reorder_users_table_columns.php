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
        Schema::table('users', function (Blueprint $table) {
            // Drop columns
            $table->dropColumn(['address', 'date_of_birth', 'phone', 'image']);
        });

        Schema::table('users', function (Blueprint $table) {
            // Add columns in desired order
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->date('date_of_birth')->nullable()->after('address');
            $table->string('image')->nullable()->after('date_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop columns
            $table->dropColumn(['phone', 'address', 'date_of_birth', 'image']);
        });

        Schema::table('users', function (Blueprint $table) {
            // Add columns back in original order
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
        });
    }
};
