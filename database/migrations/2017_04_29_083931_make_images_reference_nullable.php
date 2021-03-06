<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeImagesReferenceNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('images', function (Blueprint $table) {
            $table->string('reference_id')->nullable()->change();
            $table->string('reference_type')->nullable()->change();
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
            $table->string('reference_id')->nullable(false)->change();
            $table->string('reference_type')->nullable(false)->change();
        });
    }
}
