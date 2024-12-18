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
        Schema::table('trackings', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trackings', function (Blueprint $table) {
            $table->dropForeign('trackings_admin_id_foreign');
            $table->dropColumn('admin_id');
            $table->dropForeign('trackings_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
