<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camping_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->dateTime("exp_date");
            $table->bigInteger("assign_to")->unsigned();
            $table->foreign("assign_to")->references("id")->on("employees")->onDelete("cascade");
            $table->bigInteger("product_id")->unsigned();
            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
            $table->string("camp_type");
            $table->string("camp_status");
            $table->string("exp_response");
            $table->bigInteger("company_id")->unsigned();
            $table->foreign("company_id")->references("id")->on("companies")->onDelete("cascade");
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
        Schema::dropIfExists('camping_types');
    }
}
