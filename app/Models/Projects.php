<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';
    protected $dates = ['created_at','updated_at'];
    public $timestamps = true;

    public function seminars(){
        return $this->hasMany('App\Models\Seminar','project_code','project_code');
    }
}