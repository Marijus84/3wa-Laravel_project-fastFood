<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voids
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('delivery_speed')->unsigned()->nullable();
            $table->integer('cleanliness')->unsigned()->nullable();
            $table->integer('staff')->unsigned()->nullable();
            $table->integer('bathroom_quality')->unsigned()->nullable();
            $table->integer('drive_through')->unsigned()->nullable();
            $table->string('image_url');
            $table->text('review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
