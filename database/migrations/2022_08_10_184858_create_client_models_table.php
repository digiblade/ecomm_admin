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
        Schema::create('client_models', function (Blueprint $table) {
            $table->id("client_pk");
            $table->string("client_id");
            $table->string("client_fullname");
            $table->string("client_email");
            $table->string("client_contact");
            $table->string("client_password");
            $table->boolean("client_isactive")->default(true);
            $table->boolean("client_isverified")->default(false);
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
        Schema::dropIfExists('client_models');
    }
};
