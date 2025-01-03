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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('admin_id')->constrainedTo('users');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('admin_type');
            $table->string('profile_pic')->nullable();
            $table->integer('status')->nullable();
            $table->string('last_online')->nullable();
            //$table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
