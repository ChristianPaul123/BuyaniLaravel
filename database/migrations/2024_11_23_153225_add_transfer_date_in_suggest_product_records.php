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
        Schema::table('suggest_product_records', function (Blueprint $table) {
            $table->date('transfer_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suggest_product_records', function (Blueprint $table) {
            $table->dropColumn('transfer_date');
        });
    }
};