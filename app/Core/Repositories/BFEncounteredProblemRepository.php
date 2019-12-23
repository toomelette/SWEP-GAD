<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\BFEncounteredProblemInterface;

use App\Models\BFEncounteredProblem;


class BFEncounteredProblemRepository extends BaseRepository implements BFEncounteredProblemInterface {
	

    protected $bf_encountered_problem;

	public function __construct(BFEncounteredProblem $bf_encountered_problem){
        $this->bf_encountered_problem = $bf_encountered_problem;
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





    public function store($problem_slug, $block_farm_slug){

        $bf_encountered_problem = new BFEncounteredProblem;
        $bf_encountered_problem->problem_slug = $problem_slug;
        $bf_encountered_problem->block_farm_slug = $block_farm_slug;

        $bf_encountered_problem->save();
        return $bf_encountered_problem;
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





    public function destroy($block_farm_slug){

        $bf_encountered_problem = $this->findBySlug($block_farm_slug);
        $bf_encountered_problem->delete();
        $bf_encountered_problem->seminarParticipant()->delete();
        $bf_encountered_problem->seminarSpeaker()->delete();

        return $seminar;

    }





    public function findBySlug($slug){

        // $seminar = $this->cache->remember('seminars:findBySlug:' . $slug, 240, function() use ($slug){
        //     return $this->seminar->where('slug', $slug)->first();
        // }); 
        
        // if(empty($seminar)){ abort(404); }

        // return $seminar;
        // $bf_encountered_problem = $this->bf_encountered_problem->where('block_farm_slug', $slug);
        // return $bf_encountered_problem;
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






    private function search($instance, $key){


    }





    private function populate($instance, $entries){


    }






}