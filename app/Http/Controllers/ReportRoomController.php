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
        $questionnaires = Questionnaire::all();
        return view('report_room.index')->with('rooms', $rooms)->with('questionnaires', $questionnaires);
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
        $student_count['all'] = $room->users()->count();
        $student_count['test'] = $results->count();
        $student_count['not_test'] = $student_count['all'] - $student_count['test'];
        $student_count['avg'] = 0;
        $sum = 0;
        foreach ($results as $result) {
            $sum += $result->score;
        }
        if ($student_count['test'] != 0)
            $student_count['avg'] = $sum / $student_count['test'];
        return view('report_room.quiz_chart')
            ->with('chart', $chart)->with('results', $results)
            ->with('student_count', $student_count);
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
        $ch = $results;
        $array_report=array();
        $title = array();
        foreach ($results as $result){
            foreach ($result->result_phase_questionnaire as $result_phase){
                $array_report[$result->user_id]['user'] = $result->user->name;
                $title[$result_phase->phase_questionnaire->id] = $result_phase->phase_questionnaire->name;
                $array_report[$result->user_id][$result_phase->phase_questionnaire->id] = $result_phase->score;
                $array_report[$result->user_id][$result_phase->phase_questionnaire->id.'(แปลผล)'] = $result_phase->result_measurement();
            }

        }
       //dd($array_report);
//        $result_report = ResultQuestionnaire::
//        join ('result_phase_questionnaires', 'result_phase_questionnaires.result_questionnaire_id','result_questionnaires.id')->
//        join ('phase_questionnaires', 'phase_questionnaires.id','result_phase_questionnaires.phase_questionnaire_id')->
//        where('room_id', $room->id)
//            ->where('result_questionnaires.questionnaire_id', $questionnaire->id);


        return view('report_room.questionnaire_chart')
            ->with('chart', $chart)->with('results',$results)
            ->with('questionnaire' , $questionnaire)
            ->with('array_report', $array_report)
            ->with('title', $title);

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
