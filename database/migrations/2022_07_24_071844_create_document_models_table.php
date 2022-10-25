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
        Schema::create('document_models', function (Blueprint $table) {
            $table->id("document_pk");
            $table->uuid('document_id');
            $table->string('document_path');
            $table->string('document_label');
            $table->string('document_parentid');
            $table->string('document_type');
            $table->boolean('document_isactive')->default(true);
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
        Schema::dropIfExists('document_models');
    }
};
