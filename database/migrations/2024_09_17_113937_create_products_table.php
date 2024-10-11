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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->unique();
            $table->string('product_pic')->nullable();
            //$table->integer('product_price')->nullable();
            $table->string('product_details')->nullable();
            $table->string('product_status')->nullable();
            //$table->float('product_kg')->nullable();
            $table->string('product_deactivated')->nullable();

            //make this foriegn key migration
            //$table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreignId('subcategory_id')->nullable()->constrained('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
