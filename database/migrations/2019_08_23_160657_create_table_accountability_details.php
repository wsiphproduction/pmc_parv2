<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAccountabilityDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountabilityDetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('header_id');
            $table->integer('item');
            $table->integer('is_new');
            $table->string('status',150);
            $table->text('closed_reason');
            $table->date('closed_date');
            $table->string('closed_by',150);
            $table->text('new_condition');
            $table->integer('irms_ref');
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
