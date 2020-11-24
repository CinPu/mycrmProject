<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_companies', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("logo");
            $table->string("company_shortname");
            $table->double("phone");
            $table->double("hotline");
            $table->string("email");
            $table->text("company_website");
            $table->text("company_address");
            $table->bigInteger("admin_id")->unsigned();
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
        Schema::dropIfExists('customer_companies');
    }
}
