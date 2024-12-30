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
        Schema::create('specific_product_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_specification_id')->constrained('product_specifications')->onDelete('cascade');
            $table->foreignId('product_sale_id')->constrained('product_sales')->onDelete('cascade');
            $table->integer('order_quantity');
            $table->decimal('total_sales', 10, 2);
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specific_product_sales');
    }
};
