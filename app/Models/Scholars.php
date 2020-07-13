<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Scholars extends Model{



    protected $table = 'scholars';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
    


    protected $attributes = [

        'slug' => '' ,
        'scholar_id' => '' , 
        'resolution_no' => '',
        'scholarship_applied' => '' , 
        'course_applied' => '' , 
        'school' => '' , 
        'lastname' => '' , 
        'firstname' => '' , 
        'middlename' => '' , 
        'birth' => null , 
        'sex' => '' , 
        'civil_status' => '' , 
        'address_province' => '' , 
        'address_city' => '' , 
        'address_specific' => '' , 
        'address_no_years' => null , 
        'phone' => '' , 
        'citizenship' => '' , 
        'occupation' => '' ,
        'office_name' => '' , 
        'office_address' => '' , 
        'office_phone' => '' , 
        'mother_name' => '' , 
        'mother_phone' => '' , 
        'father_name' => '' , 
        'father_phone' => '' , 
        'spouse_name' => '' , 
        'spouse_phone' => '' , 
        'spouse_address' => '' , 
        'created_at' => null , 
        'updated_at' => null , 
        'ip_created' => '' , 
        'ip_updated' => '' , 
        'user_created' => '' , 
        'user_updated' => '',

    ];





    // /** RELATIONSHIPS **/
    // public function user() {
    // 	return $this->belongsTo('App\Models\User','user_id','user_id');
   	// }


    // public function submenu() {
    // 	return $this->hasMany('App\Models\Submenu','menu_id','menu_id');
   	// }

    public function creator(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_created');
    }

    public function updater(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_updated');
    }
    
    

    public function millDistrict()
    {
        return $this->hasOne('App\Models\MillDistrict', 'slug', 'mill_district');
    }

    



}
