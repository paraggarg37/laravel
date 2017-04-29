<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('product_category');

        Schema::table('product', function (Blueprint $table) {
            $table->integer('product_category_id');
            $table->integer('product_shop_id');
        });

        Schema::dropIfExists('shop_product');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('product_category', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('category_id');
            $table->integer('product_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn(['product_category_id','product_shop_id']);
        });
    }
}
