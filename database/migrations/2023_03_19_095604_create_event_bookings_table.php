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
        Schema::create('event_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('eventImg')->nullable();
            $table->string('senderName')->nullable();
            $table->string('senderPhone')->nullable();
            $table->string('senderId')->nullable();
            $table->string('userId')->nullable();
            $table->string('eventId')->nullable();
            $table->string('eventTitle')->nullable();
            $table->string('eventSlug')->nullable();
            $table->string('eventDescription')->nullable();
            $table->string('eventDate')->nullable();
            $table->string('eventTime')->nullable();
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
        Schema::dropIfExists('event_bookings');
    }
};
