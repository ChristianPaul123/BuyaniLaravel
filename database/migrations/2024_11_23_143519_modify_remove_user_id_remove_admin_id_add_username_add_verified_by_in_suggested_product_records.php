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
        Schema::table('suggest_product_records', function (Blueprint $table) {
            $table->dropForeign('suggest_product_records_user_id_foreign');
            $table->dropForeign('suggest_product_records_admin_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('admin_id');
            $table->string('username');
            $table->string('verified_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suggest_product_records', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->dropColumn('username');
            $table->dropColumn('verified_by');
        });
    }
};
