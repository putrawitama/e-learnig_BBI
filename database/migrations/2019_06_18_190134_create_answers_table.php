<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->char('point', 1)->nullable();
            $table->text('essay')->nullable();
            $table->json('checklists')->nullable();
            $table->unsignedBigInteger('answer_sheet_id');
            $table->unsignedBigInteger('question_id');
            $table->foreign('answer_sheet_id')->references('id')->on('answer_sheets');
            $table->foreign('question_id')->references('id')->on('questions');
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
        Schema::dropIfExists('answers');
    }
}
