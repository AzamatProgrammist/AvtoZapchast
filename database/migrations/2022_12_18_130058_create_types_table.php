<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('chiqqan_yili')->nullable();
            $table->string('kelgan_yili')->nullable();
            $table->string('size')->nullable();
            $table->string('full_price')->nullable();
            $table->string('sotish_narxi')->nullable();
            $table->string('olingan_narxi')->nullable();
            $table->string('weight')->nullable();
            $table->string('yuk_narxi')->nullable();
            $table->integer('soni')->nullable();
            $table->integer('product_id');
            $table->integer('ombor_id');
            $table->integer('shop_id')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('types');
    }
}
