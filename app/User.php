<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'card', 'password', 'std_id', 'room_id','department_id','branch_id','campus_id', 'faculty_id',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function results_questionnaire()
    {
        return $this->hasMany(ResultQuestionnaire::class);
    }

    public function rooms()
    {
        return $this->belongsTo(Room::class,'room_id');
    }
    public function departments(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function branches(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function role(){
        return $this->belongsToMany(Role::class);
    }
    public function campus(){
        return $this->belongsTo(Campus::class);
    }
    public function faculties(){
        return $this->belongsTo(Faculty::class);
    }
    public function scopeWhereRole($query){
        if(Auth::user()->hasRole('superadministrator')){
            return $this->get();
        }
        if(Auth::user()->hasRole('admincampus')){
            return $this->filterPriority()->where('campus_id',Auth::user()->campus_id);
        }
        if(Auth::user()->hasRole('adminfaculty')){
            return $this->filterPriority()->where('faculty_id',Auth::user()->faculty_id);
        }
        if(Auth::user()->hasRole('admindepartment')){
            return $this->filterPriority()->where('department_id',Auth::user()->department_id);
        }
        if(Auth::user()->hasRole('adminteacher')){
            return $this->filterPriority()->where('department_id',Auth::user()->department_id);
        }

    }

    public function scopeFilterPriority($query){
       $users = $query->with('roles')->get();
        foreach ($users as $key =>  $user){
            $priority = $user->roles[0]->priority;
            if($priority < Auth::user()->roles[0]->priority){
                //เลขน้อยกว่า ตำแหน่งปัจจุบันให้ลบตัวนนั้นทิ้ง
              unset($users[$key]);
            }
        }
        return $users;
    }
}
