<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('uom',150);
            $table->text('details');
            $table->decimal('qty',16,2);
            $table->decimal('price',16,2);
            $table->string('serialNo',150);
            $table->integer('noSerial');
            $table->integer('parentId');
            $table->string('tracking',150);
            $table->string('po',150);
            $table->string('bis',150);
            $table->string('invoice',150);
            $table->string('pldr',150);
            $table->string('rq',150);
            $table->integer('categorySeries');
            $table->integer('category');
            $table->string('size',255);
            $table->string('color',150);
            $table->string('addedBy',150);
            $table->string('img',255);
            $table->string('location',150);
            $table->integer('unpostRequest');
            $table->integer('oldpar');
            $table->integer('isict');
            $table->integer('is_deleted');
            $table->text('delete_reason');
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
