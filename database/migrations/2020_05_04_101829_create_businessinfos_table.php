<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businessinfos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_name');
            $table->integer('user_id')->nullable(false)->unique();
            $table->string('address');
            $table->string('business_email');
            $table->string('url');
            $table->integer('industry_id');
            $table->integer('type_id');
            $table->string('bank_name');
            $table->string('bank_routing_number');
            $table->string('bank_account_number');
            $table->string('tax_id_number');
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
        Schema::dropIfExists('businessinfos');
    }
}
