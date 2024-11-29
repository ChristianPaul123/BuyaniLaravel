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
        Schema::table('trackings', function (Blueprint $table) {
            $table->renameColumn('tracking_number', 'order_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trackings', function (Blueprint $table) {
            $table->renameColumn('order_number', 'tracking_number');
        });
    }
};