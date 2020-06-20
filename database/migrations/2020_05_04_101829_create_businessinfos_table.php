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
            $table->integer('user_id');
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->text('about_business')->nullable();
            $table->string('phone_number');
            $table->string('business_email');
            $table->string('url');
            $table->integer('industry_id');
            $table->integer('type_id');
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('is_verify')->default('0');
            $table->string('avatar')->default('default.jpg');
            $table->string('tax_id_number');
            $table->string('connected_stripe_account_id')->nullable();
            $table->decimal('customer_charge',7,2)->default('3.75')->nullable();
            $table->decimal('customer_cent_charge',7,2)->default('0.75')->nullable();
            $table->decimal('business_charge',7,2)->default('0.00')->nullable();
            $table->decimal('business_cent_charge',7,2)->default('0.00')->nullable();
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
