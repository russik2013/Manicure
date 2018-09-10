<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriprionLawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriprion_laws', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('subscriptions_id')->unsigned();
            $table->foreign('subscriptions_id')->references('id')->on('subscriptions');

            $table->integer('laws_id')->unsigned();
            $table->foreign('laws_id')->references('id')->on('laws');
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
        Schema::dropIfExists('subscriprion_laws');
    }
}
