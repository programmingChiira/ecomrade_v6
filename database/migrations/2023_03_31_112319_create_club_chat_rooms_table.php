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
        Schema::create('club_chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_id');
            $table->string('user_id');
            $table->string('user_name');
            $table->string('user_slug');
            $table->string('image_1')->nullable();
            $table->string('message')->nullable();
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
        Schema::dropIfExists('club_chat_rooms');
    }
};
