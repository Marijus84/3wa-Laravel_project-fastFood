<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
          $table->foreign('restaurant_id')
          ->references('id')
          ->on('restaurants')
          ->onDelete('cascade');
        });

        Schema::table('reviews', function (Blueprint $table) {
          $table->foreign('user_id')
          ->references('id')
          ->on('users')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
           $table->dropForeign('reviews_restaurant_id_foreign');
            $table->dropForeign('reviews_user_id_foreign');
        });
    }
}
