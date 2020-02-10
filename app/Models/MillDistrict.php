<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MillDistrict extends Model{





    protected $table = 'mill_district';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
    





    protected $attributes = [

        'slug' => '',
        'location' => '',
        'mill_district' => '',
        'region' => '',
        'chairman' => '',
        'address' => '',
        'mdo' => '',
        'phone' => '',
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





}
