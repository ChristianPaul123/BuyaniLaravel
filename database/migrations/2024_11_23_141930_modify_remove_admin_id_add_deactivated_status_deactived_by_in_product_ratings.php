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
        Schema::table('product_ratings', function (Blueprint $table) {
            $table->dropForeign('product_ratings_admin_id_foreign');
            $table->dropColumn('admin_id');
            $table->date('deactivated_date')->nullable();
            $table->boolean('deactivated_status')->default(0);
            $table->string('deactivated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_ratings', function (Blueprint $table) {
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->dropColumn('deactivated_status');
            $table->dropColumn('deactivated_date');
            $table->dropColumn('deactivated_by');
        });
    }
};
