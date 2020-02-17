<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Temp extends Model{



    

    protected $table = 'sra';

    public $timestamps = false;

    protected $primaryKey = 'Total_No';





    protected $attributes = [

        'Total_No' => '',
        'No' => '',
        'Resolution_No' => '',
        'Last_Name' => '',
        'First_Name' => '',
        'M_I' => '',
        'Gender' => '',
        'Brgy_Street' => '',
        'Town_City' => '',
        'Province' => '',
        'Mill_District' => '',
        'HEI' => '',
        'Course' => '',
        'Contact' => '',

    ];




    /** RELATIONSHIPS **/
    // public function menu() {
    // 	return $this->belongsTo('App\Models\Menu','menu_id','menu_id');
   	// }


    // public function creator(){
    //     return $this->hasOne("App\Models\User","user_id","user_created");
    // }

    // public function updater(){
    //     return $this->hasOne("App\Models\User","user_id","user_updated");
    // }





}
