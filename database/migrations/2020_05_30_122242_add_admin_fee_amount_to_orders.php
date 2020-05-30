<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminFeeAmountToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('admin_fee_amount',7,2)->default('0.00')->nullable()->after('used_amount');
            $table->decimal('business_user_amount',7,2)->default('0.00')->nullable()->after('admin_fee_amount');
            $table->decimal('stripe_fees',7,2)->default('0.00')->nullable()->after('business_user_amount');
            $table->string('payment_intent_client_secret')->nullable()->after('stripe_fees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('admin_fee_amount');
            $table->dropColumn('business_user_amount');
            $table->dropColumn('stripe_fees');
            $table->dropColumn('payment_intent_client_secret');
        });
    }
}
