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
        Schema::create('product_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('specification_name')->nullable();
            $table->longText('specific_product_info')->nullable();
            $table->integer('product_price')->nullable();
            $table->float('product_kg')->nullable();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->date('deactivated_date')->nullable();
            $table->boolean('deactivated_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_specifications');
    }
};
