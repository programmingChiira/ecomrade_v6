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
        Schema::create('rental_reports', function (Blueprint $table) {
            $table->id();
            $table->string('rentalImg')->nullable();
            $table->string('senderName')->nullable();
            $table->string('senderPhone')->nullable();
            $table->string('senderId')->nullable();
            $table->string('userId')->nullable();
            $table->string('rentalId')->nullable();
            $table->string('rentalName')->nullable();
            $table->string('rentalCat')->nullable();
            $table->string('rentalSlug')->nullable();
            $table->string('rentalContact')->nullable();
            $table->string('rentalPrice')->nullable();
            $table->string('rentalDiscount')->nullable();
            $table->string('rentalIssue')->nullable();
            $table->string('rentalComplaint')->nullable();
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
        Schema::dropIfExists('rental_reports');
    }
};
