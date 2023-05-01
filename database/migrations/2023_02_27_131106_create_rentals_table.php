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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('contact_information')->nullable();
            $table->string('rental_name')->nullable();
            $table->string('rental_category')->nullable();
            $table->string('no_of_rooms')->nullable();
            $table->string('maps', 500)->nullable();
            $table->string('rental_area')->nullable();
            $table->string('vacancy_status')->nullable();
            $table->string('rental_price')->nullable();
            $table->string('pay_per')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('image_6')->nullable();
            $table->string('image_7')->nullable();
            $table->string('rental_description_1', 500)->nullable();
            $table->string('rental_description_2', 500)->nullable();
            $table->string('rental_description_3', 500)->nullable();
            $table->string('rental_description_4', 500)->nullable();
            $table->string('rental_description_5', 500)->nullable();
            $table->string('rental_description_6', 500)->nullable();
            $table->string('rental_description_7', 500)->nullable();
            $table->string('rental_description_8', 500)->nullable();
            $table->string('rental_more_info', 500)->nullable();
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
        Schema::dropIfExists('rentals');
    }
};
