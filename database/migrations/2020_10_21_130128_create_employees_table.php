<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->text("emp_profile")->nullable();
            $table->string("employee_id");
            $table->string("name");
            $table->string("email");
            $table->text("nrc");
            $table->text("gender");
            $table->string("nationality")->nullable();
            $table->string("religion")->nullable();
            $table->dateTime("dob")->nullable();
            $table->string("marital_status")->nullable();
            $table->dateTime("join_date");
            $table->text("address")->nullable();
            $table->bigInteger("report_to")->unsigned();
            $table->foreign("report_to")->references("id")->on("users")->onDelete("cascade");
            $table->bigInteger("dept_id")->unsigned();
            $table->foreign("dept_id")->references("id")->on("departments")->onDelete("cascade");
            $table->string("phone");
            $table->bigInteger("dept_head")->unsigned()->nullable();
            $table->foreign("dept_head")->references("id")->on("users")->onDelete("cascade");
            $table->bigInteger("company_id")->unsigned();
            $table->foreign("company_id")->references("id")->on("companies")->onDelete("cascade");
            $table->bigInteger("emp_post")->unsigned();
            $table->foreign("emp_post")->references("id")->on("positions")->onDelete("cascade");
            $table->bigInteger("admin_id")->unsigned();
            $table->foreign("admin_id")->references("id")->on("users")->onDelete("cascade");
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
        Schema::dropIfExists('employees');
    }
}
