<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeminarSpeaker extends Model{


    protected $table = 'seminar_speakers';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
   



    protected $attributes = [

        'seminar_id' => '',
        'seminar_speaker_id' => '',
        'fullname' => '',
        'topic' => '',
        
    ];





    /** RELATIONSHIPS **/

    public function seminar() {
        return $this->belongsTo('App\Models\Seminar','seminar_id','seminar_id');
    }




    
}
