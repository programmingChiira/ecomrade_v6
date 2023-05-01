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
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->string('sender_id')->nullable();
            $table->string('sender_image')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_slug')->nullable();
            $table->string('receiver_id')->nullable();
            $table->string('receiver_image')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_slug')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('connections');
    }
};
