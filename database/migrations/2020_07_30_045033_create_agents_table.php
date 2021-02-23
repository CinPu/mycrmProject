<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("agent_id")->unsigned();
            $table->foreign("agent_id")->references("id")->on("users")->onDelete('cascade');
            $table->integer("admin_id");
            $table->bigInteger("dept_id")->unsigned();
            $table->foreign("dept_id")->references("id")->on("departments")->onDelete('cascade');
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
        Schema::dropIfExists('agents');
    }
}
