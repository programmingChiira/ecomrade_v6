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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->foreignId('user_id');
            $table->string('user_name');
            $table->string('user_slug');
            $table->string('resource_1')->nullable();
            $table->string('resource_2')->nullable();
            $table->string('resource_3')->nullable();
            $table->string('resource_4')->nullable();
            $table->string('resource_5')->nullable();
            $table->string('academic_year')->nullable();
            $table->string('course')->nullable();
            $table->string('club_id')->nullable();
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
        Schema::dropIfExists('resources');
    }
};
