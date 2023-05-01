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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->foreignId('user_id');
            $table->string('user_name');
            $table->string('user_slug');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('description', 500)->nullable();
            $table->string('requirement_1')->nullable();
            $table->string('requirement_2')->nullable();
            $table->string('requirement_3')->nullable();
            $table->string('requirement_4')->nullable();
            $table->string('requirement_5')->nullable();
            $table->string('mode')->nullable();
            $table->string('area')->nullable();
            $table->string('location', 500)->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('entry')->nullable();
            $table->string('entry_cost')->nullable();
            $table->string('contact')->nullable();
            $table->string('show_contact')->nullable();
            $table->string('club_id')->nullable();
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
