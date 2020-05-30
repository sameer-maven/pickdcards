<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConnectedStripeAccountIdToBusinessinfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businessinfos', function (Blueprint $table) {
            $table->string('connected_stripe_account_id')->nullable()->after('tax_id_number');
            $table->decimal('customer_charge',7,2)->default('3.75')->nullable()->after('connected_stripe_account_id');
            $table->decimal('customer_cent_charge',7,2)->default('0.75')->nullable()->after('customer_charge');
            $table->decimal('business_charge',7,2)->default('2.00')->nullable()->after('customer_cent_charge');
            $table->decimal('business_cent_charge',7,2)->default('0.00')->nullable()->after('business_charge');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businessinfos', function (Blueprint $table) {
            $table->dropColumn('connected_stripe_account_id');
            $table->dropColumn('customer_charge');
            $table->dropColumn('business_charge');
            $table->dropColumn('customer_cent_charge');
            $table->dropColumn('business_cent_charge');
        });
    }
}
