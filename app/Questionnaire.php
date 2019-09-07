<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Questionnaire extends Model
{
    protected $fillable = ['name', 'detail', 'category_questionnaire_id', 'type'];

    public function category()
    {
        return $this->belongsTo(CategoryQuestionnaire::class, 'category_questionnaire_id');
    }

    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function phase_questionnaires()
    {
        return $this->hasMany(PhaseQuestionnaire::class);
    }

    public function count_public()
    {
        return $this->phase_questionnaires()->where('public', true)->count();
    }

    public function question_count()
    {
        $phases = $this->phase_questionnaires()->where('public', true)->get();
        $sum = 0;
        foreach ($phases as $phase) {
            $sum += $phase->question_phase_questionnaires()->count('id');
        }
        return $sum;
    }

    public function measurements_questionnaire()
    {
        return $this->hasMany(MeasurementQuestionnaire::class);
    }

    public function room_questionnaires()
    {
        return $this->hasMany(RoomQuestionnaire::class);
    }

    public function hasRoom($room)
    {
        $check = $this->room_questionnaires()->where('room_id', $room->id)->count();
        if ($check > 0) {
            return true;
        }
        return false;
    }

    public function hasTest()
    {
        $has = ResultQuestionnaire::where('user_id', Auth::id())
            ->where('questionnaire_id', $this->id)->count();
        if ($has > 0)
            return true;
        return false;
    }

    //For Return User
    public function roomResult()
    {
        $result = ResultQuestionnaire::where('user_id', Auth::id())
            ->where('questionnaire_id', $this->id)
            ->where('room_id', Auth::user()->room_id)
            ->first();
        return $result;
    }

    //For Admin
    public function room_result($room)
    {
        $result = ResultQuestionnaire::where('questionnaire_id', $this->id)
            ->where('room_id', $room)
            ->first();
        return $result;
    }

    public function group_questionnaires(){
        return $this->hasMany(GroupQuestionnaire::class);
    }

    public function option_questionnaires(){
        return $this->hasMany(OptionQuestionnaire::class);

    }


}
