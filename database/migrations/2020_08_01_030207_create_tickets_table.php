<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("user_id");
            $table->string("ticket_id")->unique();
            $table->bigInteger("userinfo_id")->unsigned();
            $table->foreign("userinfo_id")->references("id")->on("user_informations")->onDelete("cascade");
            $table->string("phone");
            $table->text("message");
            $table->string("title");
            $table->bigInteger("status")->unsigned();
            $table->foreign("status")->references('id')->on('statuses')->onDelete('cascade');
            $table->bigInteger("case_type")->unsigned();
            $table->foreign("case_type")->references('id')->on('case_types')->onDelete('cascade');
            $table->text("product");
            $table->bigInteger("priority")->unsigned();
            $table->foreign("priority")->references('id')->on('priorities')->onDelete('cascade');
            $table->text("photo");
            $table->bigInteger("source")->unsigned();
            $table->foreign("source")->references('id')->on('sources')->onDelete('cascade');
            $table->tinyInteger("isassign");
            $table->double("lat");
            $table->double("lng");
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
        Schema::dropIfExists('tickets');
    }
}
