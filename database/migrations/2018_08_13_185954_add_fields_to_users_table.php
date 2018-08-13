<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('verificationCode');
            $table->string('city');
            $table->string('firstName');
            $table->string('lastName');
            $table->integer('age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('verificationCode');
            $table->dropColumn('city');
            $table->dropColumn('firstName');
            $table->dropColumn('lastName');
            $table->dropColumn('age');
        });
    }
}
