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
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign('blogs_admin_id_foreign');
            $table->dropColumn('admin_id');
            $table->boolean('deactivated_status')->default(0);
            $table->string('added_by')->nullable();
            $table->string('removed_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->dropColumn('deactivated_status');
            $table->dropColumn('added_by');
            $table->dropColumn('removed_by');
        });
    }
};
