<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUnpostRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unpostRequest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('par_id');
            $table->string('status', 150);
            $table->text('reason');
            $table->text('disapproved_reason');
            $table->string('requested_by',150);
            $table->date('requested_date');
            $table->integer('is_approved');
            $table->string('approved_by',150);
            $table->date('approved_date');
            $table->integer('is_served');
            $table->string('type',150);
            $table->text('e_subject');
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
