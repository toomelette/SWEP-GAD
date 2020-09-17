<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class AFDHREmployees extends Model{


    protected $connection = 'mysql_external';
    protected $table = 'hr_employees';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;
    


    protected $attributes = [

       
        

    ];





    // // /** RELATIONSHIPS **/


    // public function creator(){
    //     return $this->hasOne('App\Models\User', 'user_id', 'user_created');
    // }

    // public function updater(){
    //     return $this->hasOne('App\Models\User', 'user_id', 'user_updated');
    // }
    
    
    // public function employeeOnAfd(){
    //     return $this->setConnection('mysql_external')->hasOne('hr_employees','slug','slug_afd');
    // }

   
    



}
