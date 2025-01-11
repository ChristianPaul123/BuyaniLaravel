<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCommentColumnInOrderRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_ratings', function (Blueprint $table) {
            // Make the 'comment' column nullable
            $table->text('comment')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_ratings', function (Blueprint $table) {
            // Rollback: Make 'comment' column non-nullable
            $table->text('comment')->nullable(false)->change();
        });
    }
}
