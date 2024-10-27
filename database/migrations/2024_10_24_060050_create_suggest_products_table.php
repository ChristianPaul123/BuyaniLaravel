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
        Schema::create('suggest_products', function (Blueprint $table) {
            $table->id();
            $table->string('suggest_name')->unique();
            $table->string('suggest_description');
            $table->string('suggest_image');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->bigInteger('total_vote_count')->nullable(0);
            $table->boolean('is_accepted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suggest_products');
    }
};
