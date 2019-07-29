<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('competency');
            $table->unsignedSmallInteger('score');
            $table->text('evidence')->nullable();
            $table->unsignedBigInteger('interview_form_id');
            $table->foreign('interview_form_id')->references('id')->on('interview_forms');
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
        Schema::dropIfExists('competencies');
    }
}
