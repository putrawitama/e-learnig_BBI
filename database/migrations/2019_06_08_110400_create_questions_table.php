<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('number');
            $table->text('body');
            $table->string('answer_type')->default('MULTIPLE'); // multiple, essay, checklist
            $table->text('essay')->nullable();
            $table->unsignedSmallInteger('score')->nullable();
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('case_study_id')->nullable();
            $table->timestamps();
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('case_study_id')->references('id')->on('case_studies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
