<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\BlockFarmProblemInterface;

use App\Models\BlockFarmProblem;


class BlockFarmProblemRepository extends BaseRepository implements BlockFarmProblemInterface {
	

    protected $block_farm;

	public function __construct(BlockFarmProblem $block_farm_problem){
        $this->block_farm_problem = $block_farm_problem;
        parent::__construct();
    }





    public function fetch(){

        $problems = $this->block_farm_problem->get();
        return $problems;
    }





    public function store($request, $filename){

        // $seminar = new Seminar;
        // $seminar->seminar_id = $this->getSeminarIdInc();
        // $seminar->slug = $this->str->random(16);
        // $seminar->title = $request->title;
        // $seminar->sponsor = $request->sponsor;
        // $seminar->venue = $request->venue;
        // $seminar->date_covered_from = $this->__dataType->date_parse($request->date_covered_from);
        // $seminar->date_covered_to = $this->__dataType->date_parse($request->date_covered_to);
        // $seminar->attendance_sheet_filename = $filename;
        // $seminar->created_at = $this->carbon->now();
        // $seminar->updated_at = $this->carbon->now();
        // $seminar->ip_created = request()->ip();
        // $seminar->ip_updated = request()->ip();
        // $seminar->user_created = $this->auth->user()->user_id;
        // $seminar->user_updated = $this->auth->user()->user_id;
        // $seminar->save();
        
        // return $seminar;

    }





    public function update($request, $filename, $seminar){

        // $seminar->title = $request->title;
        // $seminar->sponsor = $request->sponsor;
        // $seminar->venue = $request->venue;
        // $seminar->date_covered_from = $this->__dataType->date_parse($request->date_covered_from);
        // $seminar->date_covered_to = $this->__dataType->date_parse($request->date_covered_to);
        // $seminar->attendance_sheet_filename = $filename;
        // $seminar->updated_at = $this->carbon->now();
        // $seminar->ip_updated = request()->ip();
        // $seminar->user_updated = $this->auth->user()->user_id;
        // $seminar->save();

        // $seminar->seminarSpeaker()->delete();

        // return $seminar;

    }





    public function destroy($slug){

        // $seminar = $this->findBySlug($slug);
        // $seminar->delete();
        // $seminar->seminarParticipant()->delete();
        // $seminar->seminarSpeaker()->delete();

        // return $seminar;

    }





    public function findBySlug($slug){

        // $seminar = $this->cache->remember('seminars:findBySlug:' . $slug, 240, function() use ($slug){
        //     return $this->seminar->where('slug', $slug)->first();
        // }); 
        
        // if(empty($seminar)){ abort(404); }

        // return $seminar;

    }






    private function getSeminarIdInc(){

        // $id = 'S10001';
        // $seminar = $this->seminar->select('seminar_id')->orderBy('seminar_id', 'desc')->first();

        // if($seminar != null){
        //     $num = str_replace('S', '', $seminar->seminar_id) + 1;
        //     $id = 'S' . $num;
        // }
        
        // return $id;
        
    }






    private function search($instance, $key){


    }





    private function populate($instance, $entries){


    }






}