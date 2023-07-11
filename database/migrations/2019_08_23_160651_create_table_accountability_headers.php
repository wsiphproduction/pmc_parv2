<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAccountabilityHeaders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountabilityHeaders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id', 150);
            $table->string('dept_id', 200);
            $table->integer('is_dept');
            $table->string('bis_header_id',150);
            $table->string('ref_code',150);
            $table->date('document_date');
            $table->string('added_by',150);
            $table->string('po',150);
            $table->string('doc_status',150);
            $table->string('safety',150);
            $table->string('posted_by',150);
            $table->date('posted_date');
            $table->integer('unpost_request');
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
