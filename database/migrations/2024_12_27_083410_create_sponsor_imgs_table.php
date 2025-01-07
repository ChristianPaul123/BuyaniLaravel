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
        Schema::create('sponsor_imgs', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->string('img_title')->nullable();
            $table->foreignId('admin_id')->constrained('admins')->nullable();
            $table->date('deactivated_date')->nullable();
            $table->boolean('deactivated_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsor_imgs');
    }
};
