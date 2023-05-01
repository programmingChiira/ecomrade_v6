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
        Schema::create('market_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('ratingValue')->nullable();
            $table->string('senderName')->nullable();
            $table->string('senderId')->nullable();
            $table->string('userId')->nullable();
            $table->string('marketId')->nullable();
            $table->string('marketName')->nullable();
            $table->string('marketCat')->nullable();
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
        Schema::dropIfExists('market_reviews');
    }
};
