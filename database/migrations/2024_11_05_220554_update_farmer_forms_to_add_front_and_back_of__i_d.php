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
        Schema::table('farmer_forms', function (Blueprint $table) {
            $table->dropColumn('identification_card');
            $table->string('identification_card_front')->nullable()->after('user_id');
            $table->string('identification_card_back')->nullable()->after('user_id');
            $table->string('response')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('farmer_forms', function (Blueprint $table) {
            $table->string('identification_card')->nullable();
            $table->dropColumn('identification_card_front');
            $table->dropColumn('identification_card_back');
            $table->dropColumn('response');

        });
    }
};
