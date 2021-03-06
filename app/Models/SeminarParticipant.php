<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeminarParticipant extends Model{


    protected $table = 'seminar_participants';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
   



    protected $attributes = [

        'slug' => '',
        'seminar_id' => '',
        'seminar_participant_id' => '',
        'fullname' => '',
        'occupation' => '',
        'age' => null,
        'sex' => '',
        'civil_status' => '',
        'educ_att' => '',
        'contact_no' => '',
        'no_children' => null,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];





    /** RELATIONSHIPS **/

    public function seminar() {
        return $this->belongsTo('App\Models\Seminar','seminar_id','seminar_id');
    }




    
}
