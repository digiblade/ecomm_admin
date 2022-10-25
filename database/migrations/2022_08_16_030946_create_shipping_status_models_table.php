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
        Schema::create('shipping_status_models', function (Blueprint $table) {
            $table->id('shipping_pk');
            $table->string('shipping_id');
            $table->string('shipping_orderid');
            $table->string('payment_type')->default("1");
            $table->string('shipping_status')->default("1");

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
        Schema::dropIfExists('shipping_status_models');
    }
};
