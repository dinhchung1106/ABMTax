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
        // Đã unique ở migration gốc, không cần thêm ở đây nữa
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Không cần drop unique ở đây
    }
};
