<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("customer_id")->nullable();
            $table->text("profile")->nullable();
            $table->string("customer_name");
            $table->string("phone")->nullable();
            $table->string("email")->unique();
            $table->bigInteger("position")->unsigned()->nullable();
            $table->foreign("position")->references("id")->on("positions")->onDelete("cascade");
            $table->string("department")->nullable();
            $table->bigInteger("company_id")->unsigned()->nullable();
            $table->foreign("company_id")->references("id")->on("companies")->onDelete("cascade");
            $table->text("address")->nullable();
            $table->bigInteger("admin_id")->unsigned();
            $table->foreign("admin_id")->references("id")->on("users")->onDelete("cascade");
            $table->string("report_to")->nullable();
            $table->bigInteger("admin_company_id")->unsigned()->nullable();
            $table->foreign("admin_company_id")->references("id")->on("companies")->onDelete("cascade");
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
        Schema::dropIfExists('customers');
    }
}
