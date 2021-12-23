<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('login_id');
            $table->string('offer_name');
            $table->tinyInteger('offer_type');
            $table->integer('offer_amount');
            $table->date('offer_start_date');
            $table->date('offer_end_date');
            $table->timestamps();
            $table->integer('status')->comment('1=active,0=inactive');
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
        Schema::dropIfExists('offers');
    }
}
