<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use App\Quiz;
use App\Result;
use App\ResultQuestionnaire;
use App\Room;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;

class ReportRoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(10);
        return view('report_room.index')->with('rooms', $rooms);
    }

    public function show(Room $room)
    {
        return view('report_room.show')->with('room', $room);
    }

    public function chart_quiz(Room $room, Quiz $quiz)
    {
        $results = Result::where('room_id', $room->id)->where('quiz_id', $quiz->id)->get();
        if (!$results->isEmpty()) {
            $hashs = $this->hashQuizUser($results);
            $chart = Charts::create('bar', 'highcharts')
                ->title("ผลการทดสอบ")
                ->labels($hashs['user'])
                ->values($hashs['score'])
                ->elementLabel($quiz->name . " คะแนนที่ได้รับ ");
        } else {
            $chart = '';
        }
        return view('report_room.quiz_chart')
            ->with('chart', $chart);
    }

    public function chart_questionnaire(Room $room, Questionnaire $questionnaire)
    {
        $chart = '';
        $results = ResultQuestionnaire::where('room_id', $room->id)->where('questionnaire_id', $questionnaire->id)->get();
        if (!$results->isEmpty()) {
            if ($questionnaire->type == 'S') {
                $hashs = $this->hasQuestionnaireUser($results);
                $chart = Charts::create('bar', 'highcharts')
                    ->title("ผลการทดสอบ")
                    ->labels($hashs['user'])
                    ->values($hashs['score'])
                    ->elementLabel($questionnaire->name . " คะแนนที่ได้รับ ");
            } else if ($questionnaire->type == 'P') {
                $hashs = $this->hasQuestionnairePhaseUser($results);
                $chart = Charts::multi('bar', 'highcharts')
                    ->title('ผลการทดสอบ')
                    ->labels($hashs['user']);
                foreach ($hashs['score'] as $key => $phase) {
                    $chart->dataset($key, $phase);
                }
            } else if ($questionnaire->type == 'SP') {
                $hashs = $this->hasQuestionnairePhaseSumUser($results);
                $chart = Charts::multi('bar', 'highcharts')
                    ->title('ผลการทดสอบ')
                    ->labels($hashs['user'])
                    ->dataset('ผลรวม', $hashs['sum']);
                foreach ($hashs['score'] as $key => $phase) {
                    $chart->dataset($key, $phase);
                }
            }
        }




        return view('report_room.questionnaire_chart')
            ->with('chart', $chart);
    }

    private function hashQuizUser($results)
    {
        $hash = array();

        foreach ($results as $result) {
            $hash['user'][] = $result->user->name;
            $hash['score'][] = $result->score;
        }
        return $hash;
    }

    private function hasQuestionnaireUser($results)
    {
        $hash = array();

        foreach ($results as $result) {
            $hash['user'][] = $result->user->name;
            $hash['score'][] = $result->score;
        }
        return $hash;
    }

    private function hasQuestionnairePhaseUser($results)
    {
        $hash = array();
        foreach ($results as $result) {
            $hash['user'][] = $result->user->name;
            foreach ($result->result_phase_questionnaire as $phase) {
                $hash['score'][$phase->phase_questionnaire->name][] = $phase->score;
            }
        }

        return $hash;
    }

    private function hasQuestionnairePhaseSumUser($results)
    {
        $hash = array();
        foreach ($results as $result) {
            $hash['user'][] = $result->user->name;
            $hash['sum'][] = $result->score;
            foreach ($result->result_phase_questionnaire as $phase) {
                $hash['score'][$phase->phase_questionnaire->name][] = $phase->score;
            }
        }

        return $hash;
    }

    private function hasPhase(Questionnaire $questionnaire)
    {
        $hash = array();
        foreach ($questionnaire->phase_questionnaires as $phase_questionnaire) {
            $hash[] = $phase_questionnaire->name;
        }
        return $hash;
    }
}
