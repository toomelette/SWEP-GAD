<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class BFMemberFamily extends Model{





    protected $table = 'block_farm_members_family';

    protected $dates = ['created_at', 'updated_at'];
    
    public $timestamps = true;
    


    protected $attributes = [
        'slug' => '',
        'bf_member' => '',
        'lastname' => null,
        'firstname' => '',
        'middlename' => '',
        'sex' => '',
        'bday' => null,
        'civil_status' => '',
        'educ_att' => '',
        'eco_status' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',
    ];





    /** RELATIONSHIPS **/

    

    public function creator(){
        return $this->hasOne("App\Models\User","user_id","user_created");
    }

    public function updater(){
        return $this->hasOne("App\Models\User","user_id","user_updated");
    }

    // public function millDistrict(){
    //     return $this->hasOne("App\Models\MillDistrict","slug","mill_district");
    // }

    // public function blockFarmProblem() {
    //     return $this->hasMany('App\Models\blockFarmProblem','slug','slug');
    // }

    // public function seminarSpeaker() {
    //     return $this->hasMany('App\Models\SeminarSpeaker','seminar_id','seminar_id');
    // }

    




}
