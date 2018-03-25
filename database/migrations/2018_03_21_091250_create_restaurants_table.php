<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('network');
            $table->string('adress_line_1');
            $table->string('city');
            $table->string('post_code');
            $table->string('phone');
            $table->string('image_url');
            $table->double('avg_staff', 3, 1)->default(1.0)->nullable();
            $table->double('avg_delivery_speed', 3, 1)->default(1.0)->nullable();
            $table->double('avg_cleanliness', 3, 1)->default(1.0)->nullable();
            $table->double('avg_bathroom_quality', 3, 1)->default(1.0)->nullable();
            $table->double('avg_drive_through', 3, 1)->default(1.0)->nullable();
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
        Schema::dropIfExists('restaurants');
    }
}
