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
            $table->string('product_name')->charset('utf8mb4');
            $table->string('product_slug')->charset('utf8mb4');
            $table->string('product_code')->charset('utf8mb4');
            $table->integer('product_quantity');
            $table->integer('product_price');
            $table->string('product_description', 255)->charset('utf8mb4');
            $table->string('product_image')->charset('utf8mb4');
            $table->tinyInteger('status')->comment('1=show, 0=hide');

            $table->foreignId('login_id');
            $table->foreignId('unit_id');
            $table->foreignId('category_id');
            $table->foreignId('offer_id')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
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
