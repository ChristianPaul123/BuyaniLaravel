<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *         'user_id',
        'otp',
        'otp_expiry',
        'v_purpose',
        'is_verified',
     */
    public function up(): void
    {
        Schema::create('otp_verifies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('otp');
            $table->dateTime('otp_expiry');
            $table->string('v_purpose');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_verifies');
    }
};
