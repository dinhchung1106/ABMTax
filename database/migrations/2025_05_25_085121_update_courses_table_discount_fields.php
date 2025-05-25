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
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('discount_info');
            $table->decimal('discount_value', 15, 2)->nullable()->after('schedule');
            $table->enum('discount_type', ['fixed', 'percentage'])->nullable()->after('discount_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('discount_info')->nullable();
            $table->dropColumn(['discount_value', 'discount_type']);
        });
    }
};
