<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string("company_id");
            $table->string("name");
            $table->text("logo")->nullable();
            $table->text("company_registry");
            $table->text("company_mission");
            $table->text("company_vision");
            $table->string("type_of_business");
            $table->string("name_of_ceo");
            $table->text("facebookpage");
            $table->text("linkedin");
            $table->string("parent_company");
            $table->string("phone");
            $table->string("hotline");
            $table->string("email")->unique();
            $table->text("company_website");
            $table->tinyInteger("is_admin_company");
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
        Schema::dropIfExists('companies');
    }
}
