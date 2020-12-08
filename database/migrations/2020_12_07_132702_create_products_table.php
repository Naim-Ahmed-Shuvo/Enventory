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
            $table->string('cat_id')->nullable();
            $table->string('p_name')->nullable();
            $table->string('sup_id')->nullable();
            $table->string('p_code')->nullable();
            $table->string('p_garage')->nullable();
            $table->string('p_route')->nullable();
            $table->string('p_image')->nullable();
            $table->string('buy_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('buying_price')->nullable();
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
