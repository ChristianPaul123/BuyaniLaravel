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
        Schema::table('product_specifications', function (Blueprint $table) {
            #change product_specifications product_price to decimal (8,2)
            $table->decimal('product_price', 8, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_specifications', function (Blueprint $table) {
            #change product_specifications product_price to decimal (8,2)
            $table->integer('product_price')->nullable()->change();
        });
    }
};
