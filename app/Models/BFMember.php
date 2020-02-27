<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class BFMember extends Model{





    protected $table = 'block_farm_members';

    protected $dates = ['created_at', 'updated_at'];
    
    public $timestamps = true;
    


    protected $attributes = [
        'slug' => '',
        'block_farm' => '',
        'crop_year' => null,
        'lastname' => '',
        'firstname' => '',
        'middlename' => '',
        'educ_att' => '',
        'sex' => '',
        'bday' => null,
        'civil_status' => '',
        'tenurial' => '',
        'years_sugarcane_farming' => null,
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

    public function blockFarm(){
        return $this->belongsTo("App\Models\BlockFarm","block_farm","slug");
    }

    public function maleFamilyMembers(){
        return $this->hasMany("App\Models\BFMemberFamily","bf_member","slug")->where('sex','=','MALE');
    }

    public function femaleFamilyMembers(){
        return $this->hasMany("App\Models\BFMemberFamily","bf_member","slug")->where('sex','=','FEMALE');
    }

    public function familyMembers(){
        return $this->hasMany("App\Models\BFMemberFamily","bf_member","slug");
    }

    

    




}
