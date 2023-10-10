<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('user_id');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('image_6')->nullable();
            $table->string('image_7')->nullable();
            $table->string('image_8')->nullable();
            $table->string('image_9')->nullable();
            $table->string('image_10')->nullable();
            $table->string('image_11')->nullable();
            $table->string('image_12')->nullable();
            $table->string('image_13')->nullable();
            $table->string('image_14')->nullable();
            $table->string('image_15')->nullable();
            $table->string('image_16')->nullable();
            $table->string('image_17')->nullable();
            $table->string('image_18')->nullable();
            $table->string('image_19')->nullable();
            $table->string('image_20')->nullable();
            $table->string('image_21')->nullable();
            $table->string('image_22')->nullable();
            $table->string('image_23')->nullable();
            $table->string('image_24')->nullable();
            $table->string('image_25')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_category')->nullable();
            $table->string('product_sub_category')->nullable();
            $table->string('product_description_1', 300)->nullable();
            $table->string('product_description_2', 300)->nullable();
            $table->string('product_description_3', 300)->nullable();
            $table->string('product_description_4', 300)->nullable();
            $table->string('product_description_5', 300)->nullable();
            $table->string('product_description_6', 300)->nullable();
            $table->string('product_description_7', 300)->nullable();
            $table->string('product_more_info', 700)->nullable();
            $table->string('size')->nullable();
            $table->string('gender')->nullable();
            $table->string('color')->nullable();
            $table->string('location')->nullable();
            $table->string('availability')->nullable();
            $table->string('contact')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_discount')->nullable();
            $table->string('product_service')->nullable();
            $table->string('club_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('markets');
    }
};