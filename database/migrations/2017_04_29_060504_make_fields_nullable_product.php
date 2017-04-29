<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeFieldsNullableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->change();
        });

        Schema::table('category', function (Blueprint $table) {
            $table->string('category_description')->nullable()->change();
        });

        Schema::table('product', function (Blueprint $table) {
            $table->string('product_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('images', function (Blueprint $table) {
            $table->string('image_alt')->nullable(false)->change();
        });

        Schema::table('category', function (Blueprint $table) {
            $table->string('category_description')->nullable(false)->change();
        });

        Schema::table('product', function (Blueprint $table) {
            $table->string('product_description')->nullable(false)->change();
        });
    }
}
