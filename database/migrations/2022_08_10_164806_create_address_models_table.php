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
        Schema::create('address_models', function (Blueprint $table) {
            $table->id('address_pk');
            $table->string('address_id');
            $table->string('address_username');
            $table->string('address_detail');
            $table->string('address_pincode');
            $table->string('address_type')->default("1");
            $table->string('address_uid');
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
        Schema::dropIfExists('address_models');
    }
};
