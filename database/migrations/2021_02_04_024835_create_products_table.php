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
            $table->increments('Product_Id');
            $table->string('Product_Name');
            $table->double('Product_Price');
            $table->integer('Product_Sale');
            $table->string('Product_Image_1');
            $table->string('Product_Image_2');
            $table->string('Product_Image_3');
            $table->string('Product_Desc');
            $table->string('Product_Unit');
            $table->integer('Product_Quantity');
            $table->float('Product_Rating');
            $table->boolean('Product_Status');
            $table->integer('Category_Id');
            $table->foreign('Category_Id')->references('Category_Id')->on('Categorys');
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