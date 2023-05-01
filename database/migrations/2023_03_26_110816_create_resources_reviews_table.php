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
        Schema::create('resource_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('ratingValue')->nullable();
            $table->string('senderName')->nullable();
            $table->string('senderId')->nullable();
            $table->string('userId')->nullable();
            $table->string('resourceId')->nullable();
            $table->string('resourceTitle')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('resource_reviews');
    }
};
