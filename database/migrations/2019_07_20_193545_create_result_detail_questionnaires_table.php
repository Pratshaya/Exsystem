<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultDetailQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_detail_questionnaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('result_phase_questionnaire_id');
            $table->integer('question_phase_questionnaire_id');
            $table->integer('option_phase_questionnaire_id');
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
        Schema::dropIfExists('result_detail_questionnaires');
    }
}
