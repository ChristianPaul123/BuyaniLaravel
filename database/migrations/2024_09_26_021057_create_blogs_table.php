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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('blog_title')->unique();
            $table->longText('blog_info')->nullable();
            $table->string('blog_pic')->nullable();
            $table->string('removed_date')->nullable();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
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
        Schema::dropIfExists('blogs');
    }
};
