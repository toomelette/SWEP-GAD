<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Seminar extends Model{



    use Sortable;


    protected $table = 'seminars';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
    
    public $sortable = ['title', 'sponsor', 'venue', 'date_covered_from', 'date_covered_to'];

    


    protected $attributes = [
        'slug' => '',
        'seminar_id' => '',
        'title' => '',
        'sponsor' => '',
        'venue' => '',
        'mill_district' => '',
        'date_covered_from' => null,
        'date_covered_to' => null,
        'attendance_sheet_filename' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',
    ];





    /** RELATIONSHIPS **/

    public function seminarParticipant() {
        return $this->hasMany('App\Models\SeminarParticipant','seminar_id','seminar_id');
    }

    public function seminarParticipant_male() {
        return $this->hasMany('App\Models\SeminarParticipant','seminar_id','seminar_id')->where('sex','=','MALE');
    }

    public function seminarParticipant_female() {
        return $this->hasMany('App\Models\SeminarParticipant','seminar_id','seminar_id')->where('sex','=','FEMALE');
    }

    public function seminarSpeaker() {
        return $this->hasMany('App\Models\SeminarSpeaker','seminar_id','seminar_id');
    }

    
    public function creator(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_created');
    }

    public function updater(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_updated');
    }


    public function millDistrict(){
        return $this->hasOne("App\Models\MillDistrict","slug","mill_district");
    }




}
