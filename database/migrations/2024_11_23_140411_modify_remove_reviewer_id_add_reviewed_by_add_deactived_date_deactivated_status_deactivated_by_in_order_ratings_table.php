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
        Schema::table('order_ratings', function (Blueprint $table) {
            $table->dropForeign('order_ratings_reviewer_id_foreign');
            $table->dropColumn('reviewer_id');
            $table->date('deactivated_date')->nullable();
            $table->boolean('deactivated_status')->default(false);
            $table->string('deactivated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_ratings', function (Blueprint $table) {
            $table->foreignId('reviewer_id')->constrained('admins')->onDelete('cascade');
            $table->dropColumn('deactivated_date');
            $table->dropColumn('deactivated_status');
            $table->dropColumn('deactivated_by');
        });
    }
};
