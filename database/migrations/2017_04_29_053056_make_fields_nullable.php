<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('shop', function (Blueprint $table) {
            $table->string('shop_description')->nullable()->change();
            $table->string('shop_logo')->nullable()->change();
            $table->string('shop_tnc')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('shop', function (Blueprint $table) {
            $table->string('shop_description')->nullable(false)->change();
            $table->string('shop_logo')->nullable(false)->change();
            $table->string('shop_tnc')->nullable(false)->change();
        });
    }
}
