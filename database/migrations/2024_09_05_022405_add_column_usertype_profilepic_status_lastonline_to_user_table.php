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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_type')->default('1')->after('password');
            $table->string('profile_pic')->nullable()->after('user_type');
            $table->boolean('status')->default(true)->after('profile_pic');
            $table->timestamp('last_online')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['user_type', 'profile_pic', 'status','last_online']);
        });
    }
};
