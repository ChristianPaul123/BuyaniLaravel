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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_product_specification_id_foreign');
            $table->dropForeign('order_items_product_id_foreign');
            $table->dropColumn(['product_specification_id', 'product_id']);
            $table->string('product_name');
            $table->string('product_specification_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('product_specification_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->dropColumn(['product_name', 'product_specification_name']);
        });
    }
};
