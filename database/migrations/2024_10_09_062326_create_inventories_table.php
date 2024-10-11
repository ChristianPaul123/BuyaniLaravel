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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->decimal('product_new_stock', 10, 2)->default(0);
            $table->decimal('product_old_stock', 10, 2)->default(0);
            $table->decimal('product_total_stock', 10, 2)->default(0);
            $table->decimal('product_sold_stock', 10, 2)->default(0);
            $table->decimal('product_damage_stock', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
