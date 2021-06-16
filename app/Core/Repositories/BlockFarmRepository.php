<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\BlockFarmInterface;

use App\Models\BlockFarm;
use App\Core\Interfaces\ActivityLogInterface;

class BlockFarmRepository extends BaseRepository implements BlockFarmInterface {
	

    protected $block_farm;
    protected $activity_log_repo;

	public function __construct(BlockFarm $block_farm,ActivityLogInterface $activity_log_repo){

        $this->block_farm = $block_farm;
        $this->activity_log_repo = $activity_log_repo;
        parent::__construct();
    }





    public function fetch($request){

        // $cache_key = str_slug($request->fullUrl(), '_');
        // $entries = isset($request->e) ? $request->e : 20;

        // $seminars = $this->cache->remember('seminars:fetch:' . $cache_key, 240, function() use ($request, $entries){

        //     $seminar = $this->seminar->newQuery();
            
        //     if(isset($request->q)){ $this->search($seminar, $request->q); }

        //     return $this->populate($seminar, $entries);

        // });

        // return $seminars;

    }





    public function store($request){

        $block_farm = new BlockFarm;
        $block_farm->benchmark_info_id = $this->getBlockFarmIdInc();
        $block_farm->slug     = $this->str->random(16);
        $block_farm->date     = $this->__dataType->date_parse($request->date);
        $block_farm->mill_district = $request->mill_district;
        $block_farm->fund_source = $request->fund_source;
        $block_farm->block_farm_name = $request->block_farm_name;
        $block_farm->enrolee_name = $request->enrolee_name;
        $block_farm->address = $request->address;
        $block_farm->educ_att = $request->educ_att;
        $block_farm->sex = $request->sex;
        $block_farm->age = $request->age;
        $block_farm->civil_status = $request->civil_status;
        $block_farm->religion = $request->religion;
        $block_farm->occupation = $request->occupation;
        $block_farm->annual_income = $request->annual_income;
        $block_farm->annual_expense = $request->annual_expense;
        $block_farm->years_sugarcane_farming = $request->years_sugarcane_farming;
        $block_farm->male_family = $request->male_family;
        $block_farm->female_family = $request->female_family;

        $block_farm->plant_total_area = $request->plant_total_area;
        $block_farm->plant_lkg_tc = $request->plant_lkg_tc;
        $block_farm->plant_tc_ha = $request->plant_tc_ha;
        $block_farm->plant_lkg_ha = $request->plant_lkg_ha;
        $block_farm->ratoon_total_area = $request->ratoon_total_area;
        $block_farm->ratoon_lkg_tc = $request->ratoon_lkg_tc;
        $block_farm->ratoon_tc_ha = $request->ratoon_tc_ha;
        $block_farm->ratoon_lkg_ha = $request->ratoon_lkg_ha;
        $block_farm->specify_problem = $request->specify_problem;

        $block_farm->created_at = $this->carbon->now();
        $block_farm->updated_at = $this->carbon->now();
        $block_farm->ip_created = request()->ip();
        $block_farm->ip_updated = request()->ip();
        $block_farm->user_created = $this->auth->user()->user_id;
        $block_farm->user_updated = $this->auth->user()->user_id;
        $block_farm->save();

        //LOGGING
        $activity_log = collect();
        $activity_log->module = 'block_farm';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $block_farm->slug;
        $activity_log->remarks = "New data: ".$block_farm->block_farm_name;
        $this->activity_log_repo->store($activity_log);


        return $block_farm;

    }





    public function update($request,  $slug){
        $block_farm = $this->findBySlug($slug);
        $block_farm_old = $block_farm->getOriginal();


        $block_farm->date = $this->__dataType->date_parse($request->date);
        $block_farm->mill_district = $request->mill_district;
        $block_farm->fund_source = $request->fund_source;
        $block_farm->block_farm_name = $request->block_farm_name;
        $block_farm->enrolee_name = $request->enrolee_name;
        $block_farm->address = $request->address;
        $block_farm->educ_att = $request->educ_att;
        $block_farm->sex = $request->sex;
        $block_farm->age = $request->age;
        $block_farm->civil_status = $request->civil_status;
        $block_farm->religion = $request->religion;
        $block_farm->occupation = $request->occupation;
        $block_farm->annual_income = $request->annual_income;
        $block_farm->annual_expense = $request->annual_expense;
        $block_farm->years_sugarcane_farming = $request->years_sugarcane_farming;
        $block_farm->male_family = $request->male_family;
        $block_farm->female_family = $request->female_family;

        $block_farm->plant_total_area = $request->plant_total_area;
        $block_farm->plant_lkg_tc = $request->plant_lkg_tc;
        $block_farm->plant_tc_ha = $request->plant_tc_ha;
        $block_farm->plant_lkg_ha = $request->plant_lkg_ha;
        $block_farm->ratoon_total_area = $request->ratoon_total_area;
        $block_farm->ratoon_lkg_tc = $request->ratoon_lkg_tc;
        $block_farm->ratoon_tc_ha = $request->ratoon_tc_ha;
        $block_farm->ratoon_lkg_ha = $request->ratoon_lkg_ha;
        $block_farm->specify_problem = $request->specify_problem;
        $block_farm->updated_at = $this->carbon->now();
        $block_farm->ip_updated = request()->ip();
        $block_farm->user_updated = $this->auth->user()->user_id;
        $block_farm->save();
        $block_farm->bfEncounteredProblem()->delete();

        //LOGGING
        $activity_log = collect();
        $activity_log->module = 'block_farm';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $block_farm->slug;
        $activity_log->original = $block_farm_old;
        $activity_log->obj = $block_farm;
        $this->activity_log_repo->store($activity_log);
        
        return $block_farm;
 

    }





    public function destroy($slug){
        $block_farm = $this->findBySlug($slug);

        $block_farm->delete();
        $block_farm->bfEncounteredProblem()->delete();

        //LOGGING
        $activity_log = collect();
        $activity_log->module = 'block_farm';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $block_farm->slug;
        $activity_log->remarks = "DELETED: ".$block_farm->block_farm_name;
        $this->activity_log_repo->store($activity_log);


        return $block_farm;


    }

    public function fetchTable($data){

        $get = $this->block_farm;
        $get = $get->leftJoin('mill_district','mill_district.slug', '=','block_farm.mill_district');

        if(!empty($data->mill_district)){
            $get = $get->where('block_farm.mill_district','=',$data->mill_district);
        }

        $get = $get->get([
            'block_farm.slug',
            'block_farm.block_farm_name',
            'block_farm.enrolee_name', 
            'mill_district.mill_district', 
            'block_farm.date', 
            'block_farm.fund_source'
        ]);
        return $get;
    }




    public function findBySlug($slug){

        // $seminar = $this->cache->remember('seminars:findBySlug:' . $slug, 240, function() use ($slug){
        //     return $this->seminar->where('slug', $slug)->first();
        // }); 
        
        // if(empty($seminar)){ abort(404); }

        // return $seminar;

        return $this->block_farm->where('slug', $slug)->first();
    }






    private function getBlockFarmIdInc(){

        $id = 'BF10001';
        $block_farm = $this->block_farm->select('benchmark_info_id')->orderBy('benchmark_info_id', 'desc')->first();

        if($block_farm != null){
            $num = str_replace('BF', '', $block_farm->benchmark_info_id) + 1;
            $id = 'BF' . $num;
        }
        
        return $id;
        
    }


    public function list($query){
        $block_farm = $this->block_farm->select('slug','block_farm_name')->where('block_farm_name','like','%'.$query.'%')->get();
        $list = [];

        foreach ($block_farm as $key => $value) {
            array_push($list, ['id' => $value['slug'], 'name'=> $value['block_farm_name']]);
        }
        return $list;
    }



    private function search($instance, $key){


    }





    private function populate($instance, $entries){


    }

    public function getRaw(){
        return $this->block_farm;
    }





}