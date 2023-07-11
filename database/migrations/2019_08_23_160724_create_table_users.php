<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullName',200);
            $table->string('domainAccount',200);
            $table->string('password',200);
            $table->string('role',100);
            $table->string('dept',200);
            $table->integer('isActive');
            $table->integer('isLocked');
            $table->string('addedBy',100);
            $table->date('lockedOn');
            $table->string('email',200);
            $table->rememberToken();
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
        //
    }
}
