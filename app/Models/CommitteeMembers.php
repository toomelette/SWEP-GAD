<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class CommitteeMembers extends Model{



    protected $table = 'committee_members';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
    


    protected $attributes = [

        'slug' => '',
        'fname' => '',
        'mname' => '',
        'lname' => '',
        'based_on' => '',
        'sex' => '',
        'created_at' => null , 
        'updated_at' => null , 
        'ip_created' => '' , 
        'ip_updated' => '' , 
        'user_created' => '' , 
        'user_updated' => '',
        

    ];





    // /** RELATIONSHIPS **/


    public function creator(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_created');
    }

    public function updater(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_updated');
    }
    
    
    public function employeeOnAfd(){
        return $this->hasOne('App\Models\AFDHREmployees','slug','slug_afd');
    }

   
    



}
