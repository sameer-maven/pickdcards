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
            $table->integer('user_id')->nullable(false);
            $table->string('customer_full_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->tinyInteger('status')->default('0')->comment = '0 (not paid), 1 (paid)';
            $table->string('qrcode');
            $table->decimal('balance',9,2);
            $table->decimal('amount',9,2);
            $table->decimal('used_amount',9,2);
            $table->decimal('admin_fee_amount',7,2)->default('0.00')->nullable();
            $table->decimal('business_user_amount',7,2)->default('0.00')->nullable();
            $table->decimal('stripe_fees',7,2)->default('0.00')->nullable();
            $table->string('card_code')->nullable();
            $table->string('payment_intent_client_secret')->nullable();
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
