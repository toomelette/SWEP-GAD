<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\ActivityLogInterface;
use App\Core\Interfaces\BFMemberInterface;
use App\Models\BFMember;

class BFMemberRepository extends BaseRepository implements BFMemberInterface {
	
    protected $bf_member;
    protected $activity_log_repo;

	public function __construct(ActivityLogInterface $activity_log_repo,BFMember $bf_member){

       
        $this->activity_log_repo = $activity_log_repo;
        $this->bf_member = $bf_member;

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

        
        $bf_member = new BFMember;
        $bf_member->slug = $this->str->random(16);
        $bf_member->block_farm = $request->chosen_bf;
        $bf_member->crop_year = $request->crop_year;
        $bf_member->lastname = $request->lastname;
        $bf_member->firstname = $request->firstname;
        $bf_member->middlename = $request->middlename;
        $bf_member->bday = date("Y-m-d",strtotime($request->bday));
        $bf_member->sex = $request->sex;
        $bf_member->civil_status = $request->civil_status;
        $bf_member->educ_att = $request->educ_att;
        $bf_member->years_sugarcane_farming = $request->years_sugarcane_farming;
        $bf_member->tenurial = $request->tenurial;
        $bf_member->created_at = $this->carbon->now();
        $bf_member->ip_created = request()->ip();
        $bf_member->user_created = $this->auth->user()->user_id;
        $bf_member->save();
        

        //LOGGING
        $activity_log = collect();
        $activity_log->module = 'bf_member';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $bf_member->slug;
        $activity_log->remarks = 
        "New data: ".
        $bf_member->lastname.", ".$bf_member->firstname;
        $this->activity_log_repo->store($activity_log);


        return $bf_member;

    }





    public function update($request,  $slug){
        

        //LOGGING
        // $activity_log = collect();
        // $activity_log->module = 'block_farm';
        // $activity_log->event = __FUNCTION__;
        // $activity_log->slug = $block_farm->slug;
        // $activity_log->original = $block_farm_old;
        // $activity_log->obj = $block_farm;
        // $this->activity_log_repo->store($activity_log);


        // return $block_farm;
 

    }





    public function destroy($slug){
  

        //LOGGING
        // $activity_log = collect();
        // $activity_log->module = 'block_farm';
        // $activity_log->event = __FUNCTION__;
        // $activity_log->slug = $block_farm->slug;
        // $activity_log->remarks = "DELETED: ".$block_farm->block_farm_name;
        // $this->activity_log_repo->store($activity_log);


        // return $block_farm;


    }

    public function fetchTable(){
        return $this->bf_member
            ->leftJoin('block_farm', 'block_farm.slug', '=', 'block_farm_members.block_farm')
            ->leftJoin('mill_district', 'mill_district.slug', '=', 'block_farm.mill_district')
            ->latest()
            ->get([
            'block_farm_members.slug',
            'block_farm.block_farm_name',
            'mill_district.mill_district',
            'lastname', 
            'firstname', 
            'middlename', 
            'block_farm', 
            'bday', 
            'block_farm_members.sex', 
            'block_farm_members.civil_status', 
            'block_farm_members.created_at'
        ]);
    }




    public function findBySlug($slug){

        // $seminar = $this->cache->remember('seminars:findBySlug:' . $slug, 240, function() use ($slug){
        //     return $this->seminar->where('slug', $slug)->first();
        // }); 
        
        // if(empty($seminar)){ abort(404); }

        // return $seminar;

        return $this->bf_member->where('slug', $slug)->first();
    }






}