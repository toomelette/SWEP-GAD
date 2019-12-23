<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class BlockFarmProblem extends Model{





    protected $table = 'block_farm_problems';

    protected $dates = ['created_at', 'updated_at'];
    
    public $timestamps = false;




    protected $attributes = [
        'slug' => '',
        'problem' => '',
        'type' => ''
    ];





    /** RELATIONSHIPS **/

    // public function BlockFarm() {
    //     return $this->belongsTo('App\Models\BlockFarm','slug','slug');
    // }


    




}
