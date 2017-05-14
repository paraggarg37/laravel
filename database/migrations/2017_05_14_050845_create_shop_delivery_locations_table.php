<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopDeliveryLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_delivery_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->integer('address_id');
        });
        Schema::table('address',function (Blueprint $table){
            $table->string('pincode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('address',function (Blueprint $table){
            $table->dropColumn(['pincode']);
        });

        Schema::dropIfExists('shop_delivery_locations');
    }
}
