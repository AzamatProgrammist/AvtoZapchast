<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Org_Dub');
            $table->string('part_number')->nullable();
            $table->string('image')->nullable();
            $table->string('model')->nullable();
            $table->string('brendi')->nullable();
            $table->string('markasi')->nullable();
            $table->string('chiqqan_yili')->nullable();
            $table->string('kelgan_yili')->nullable();
            $table->string('size')->nullable();
            $table->string('full_price')->nullable();
            $table->string('sotish_narxi')->nullable();
            $table->string('olingan_narxi')->nullable();
            $table->string('weight')->nullable();
            $table->string('yuk_narxi')->nullable();
            $table->integer('soni')->nullable();
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
        Schema::dropIfExists('products');
    }
}
