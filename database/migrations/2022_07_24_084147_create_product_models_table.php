<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_models', function (Blueprint $table) {
            $table->id("product_pk");
            $table->string("product_id");
            $table->string("category_id");
            $table->string("product_price");
            $table->string("product_merchantprice");
            $table->string("product_mrp");
            $table->string("product_name");
            $table->string("product_description")->default("");
            $table->string("product_stockcount")->default("1");
            $table->boolean("product_isactive")->default(true);
            $table->boolean("product_isverified")->default(false);
            $table->string("created_by");
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
        Schema::dropIfExists('product_models');
    }
};
