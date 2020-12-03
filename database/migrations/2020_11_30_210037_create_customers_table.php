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
            $table->string("customer_id");
            $table->text("profile")->nullable();
            $table->string("customer_name");
            $table->double("phone");
            $table->string("email")->unique();
            $table->bigInteger("position")->unsigned();
            $table->foreign("position")->references("id")->on("positions")->onDelete("cascade");
            $table->string("department");
            $table->bigInteger("company_id")->unsigned();
            $table->foreign("company_id")->references("id")->on("customer_companies")->onDelete("cascade");
            $table->text("address");
            $table->bigInteger("admin_id")->unsigned();
            $table->string("report_to");
            $table->bigInteger("admin_company_id")->unsigned();
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
