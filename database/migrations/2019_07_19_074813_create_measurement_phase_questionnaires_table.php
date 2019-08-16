<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementPhaseQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurement_phase_questionnaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('result');
            $table->integer('score_min');
            $table->integer('score_max');
            $table->integer('phase_questionnaire_id');
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
        Schema::dropIfExists('measurement_phase_questionnaires');
    }
}
