<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher')->nullable();
            $table->string('student_number')->nullable();       //学号
            $table->string('week')->nullable();                 //周
            $table->string('day')->nullable();                  //天
            $table->string('class')->nullable();                //节
            $table->string('state')->default('0');                //是否预约的状态
            $table->string('way')->nullable();                  //预约方式

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
