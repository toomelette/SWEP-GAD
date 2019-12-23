<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class BFEncounteredProblem extends Model{





    protected $table = 'block_farm_encountered_problems';

    protected $dates = ['created_at', 'updated_at'];
    
    public $timestamps = false;




    protected $attributes = [
        'problem_slug' => '',
        'block_farm_slug' => ''
    ];





    /** RELATIONSHIPS **/
    // public function blockFarm() {
    //     return $this->belongsTo('App\Models\BlockFarm','problem_slug','block_farm_slug');
    // }
    public function blockFarm() {
        return $this->belongsTo('App\Models\BlockFarm','problem_slug','block_farm_slug');
    }

    public function blockFarmProblem() {
        return $this->hasOne('App\Models\BlockFarmProblem','slug','problem_slug');
    }
    
    // public function blockFarmProblem()
    // {
    //     return $this->hasOne('App\Models\BlockFarmProblem','slug','problem_slug');
    // }

    // public function BlockFarm() {
    //     return $this->belongsTo('App\Models\BlockFarm','slug','slug');
    // }


    




}
