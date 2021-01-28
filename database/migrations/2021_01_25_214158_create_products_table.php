<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->bigInteger("tax")->unsigned();
            $table->foreign("tax")->references("id")->on("product_taxes")->onDelete("cascade");
            $table->text("description");
            $table->double("sale_price");
            $table->double("purchase_price");
            $table->bigInteger("cat_id")->unsigned();
            $table->foreign("cat_id")->references("id")->on("product_categories")->onDelete("cascade");
            $table->tinyInteger("enable");
            $table->bigInteger("company_id")->unsigned();
            $table->foreign("company_id")->references("id")->on("companies")->onDelete("cascade");
            $table->text("image");
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
        Schema::dropIfExists('products');
    }
}
