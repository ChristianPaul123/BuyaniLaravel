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
        Schema::table('payments', function (Blueprint $table) {
            // Add payment_amount as decimal(10,2) following cart style
            $table->decimal('payment_amount', 10, 2)->after('order_id');

            // Modify payment_method to integer with default 0
            $table->integer('payment_method')->default(0)->change();

            // Modify payment_status and payment_pic to be nullable
            $table->string('payment_status')->nullable()->change();
            $table->string('payment_pic')->nullable()->change();

            // Add accepted_by as unsigned big integer and set it as nullable
            $table->unsignedBigInteger('accepted_by')->nullable()->after('payment_pic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop payment_amount
            $table->dropColumn('payment_amount');

            // Revert payment_method back to its original state
            $table->string('payment_method')->change();

            // Revert payment_status and payment_pic back to non-nullable
            $table->string('payment_status')->nullable(false)->change();
            $table->string('payment_pic')->nullable(false)->change();

            // Drop accepted_by
            $table->dropColumn('accepted_by');
        });
    }
};
