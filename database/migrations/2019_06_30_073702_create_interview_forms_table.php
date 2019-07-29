<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('education');
            $table->string('unit');
            $table->string('position');
            $table->string('interviewer');
            $table->date('date_of_interview');
            $table->string('result'); // PASSED, RECONSIDERED, REJECTED
            $table->string('type')->default('SIMULATION');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('answer_id')->references('id')->on('answers');
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
        Schema::dropIfExists('interview_forms');
    }
}
