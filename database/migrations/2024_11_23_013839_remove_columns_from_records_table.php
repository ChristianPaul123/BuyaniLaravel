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
        Schema::table('records', function (Blueprint $table) {
            //this is how to drop a column with a foreign key
            $table->dropForeign('records_product_id_foreign');
            $table->dropForeign('records_inventory_id_foreign');
            $table->dropColumn('product_id');
            $table->dropColumn('inventory_id');
            $table->dropColumn('product_new_stock');
            $table->dropColumn('product_old_stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('records', function (Blueprint $table) {
            $table->foreignId('inventory_id')->constrained('inventories')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->decimal('product_new_stock', 10, 2)->default(0);
            $table->decimal('product_old_stock', 10, 2)->default(0);
        });
    }
};
