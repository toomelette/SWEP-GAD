<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class BlockFarm extends Model{





    protected $table = 'block_farm';

    protected $dates = ['created_at', 'updated_at'];
    
    public $timestamps = false;
    
    public $sortable = ['title', 'sponsor', 'venue', 'date_covered_from', 'date_covered_to'];




    protected $attributes = [
        'slug' => '',
        'benchmark_info_id' => '',
        'date' => null,
        'mill_district' => '',
        'fund_source' => '',
        'block_farm_name' => '',
        'enrolee_name' => '',
        'address' => '',
        'educ_att' => '',
        'sex' => '',
        'age' => '',
        'civil_status' => '',
        'religion' => '',
        'occupation' => '',
        'annual_income' => '',
        'annual_expense' => '',
        'years_sugarcane_farming' => '',
        'male_family' => '',
        'female_family' => '',
        'plant_total_area' => null,
        'plant_lkg_tc' => null,
        'plant_tc_ha' => null,
        'plant_lkg_ha' => null,
        'ratoon_total_area' => null,
        'ratoon_lkg_tc' => null,
        'ratoon_tc_ha' => null,
        'ratoon_lkg_ha' => null,
        'specify_problem' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',
    ];





    /** RELATIONSHIPS **/

    public function bfEncounteredProblem() {
        return $this->hasMany('App\Models\BFEncounteredProblem','block_farm_slug','slug');
    }

    public function creator(){
        return $this->hasOne("App\Models\User","user_id","user_created");
    }

    public function updater(){
        return $this->hasOne("App\Models\User","user_id","user_updated");
    }

    // public function blockFarmProblem() {
    //     return $this->hasMany('App\Models\blockFarmProblem','slug','slug');
    // }

    // public function seminarSpeaker() {
    //     return $this->hasMany('App\Models\SeminarSpeaker','seminar_id','seminar_id');
    // }

    




}
