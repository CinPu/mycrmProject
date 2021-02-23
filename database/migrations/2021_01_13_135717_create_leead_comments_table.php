<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeeadCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leead_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lead_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign("lead_id")->references('id')->on('lead_models')->onDelete('cascade');
            $table->foreign("user_id")->references('id')->on('users')->onDelete('cascade');
            $table->text('comment');
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
        Schema::dropIfExists('leead_comments');
    }
}
