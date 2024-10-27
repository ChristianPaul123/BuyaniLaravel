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
        Schema::table('orders', function (Blueprint $table) {
            // Drop the existing column
            $table->dropColumn('customer_address');

            // Add new columns
            $table->string('customer_house_number')->nullable();
            $table->string('customer_street')->nullable();

            // Modify the order_status column from boolean to tinyint for the int
            $table->tinyInteger('order_status')->change()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Restore the info from columns
            $table->string('customer_address')->nullable();
            $table->dropColumn(['customer_house_number', 'customer_street']);
            $table->boolean('order_status')->change()->default(0);
        });
    }
};
