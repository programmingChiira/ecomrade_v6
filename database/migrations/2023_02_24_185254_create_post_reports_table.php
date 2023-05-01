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
        Schema::create('post_reports', function (Blueprint $table) {
            $table->string('postImg')->nullable();
            $table->string('senderName')->nullable();
            $table->string('senderPhone')->nullable();
            $table->string('senderId')->nullable();
            $table->string('userId')->nullable();
            $table->string('postId')->nullable();
            $table->string('postName')->nullable();
            $table->string('postCat')->nullable();
            $table->string('postSlug')->nullable();
            $table->string('postIssue')->nullable();
            $table->string('postComplaint')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_reports');
    }
};
