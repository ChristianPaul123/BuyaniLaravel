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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //this is how to drop a column with a foreign key
            $table->dropForeign('products_category_id_foreign');
            $table->dropForeign('products_subcategory_id_foreign');
            $table->dropColumn('category_id');
            $table->dropColumn('subcategory_id');
        });
    }
};
