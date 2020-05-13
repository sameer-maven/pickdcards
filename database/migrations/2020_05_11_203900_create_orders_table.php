<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable(false)->unique();
            $table->string('customer_full_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_bussiness_email')->nullable();
            $table->tinyInteger('status')->default('0')->comment = '0 (not paid), 1 (paid)';
            $table->decimal('amount',9,3);
            $table->string('trx_id');
            $table->string('recipient_name');
            $table->string('recipient_email');
            $table->text('recipient_notes');
            $table->text('stripe_response');
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
        Schema::dropIfExists('orders');
    }
}
