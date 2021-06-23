<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SeminarInterface;

use App\Models\Seminar;
use App\Core\Interfaces\ActivityLogInterface;


class SeminarRepository extends BaseRepository implements SeminarInterface {
	


    protected $seminar;
    protected $activity_log_repo;

	public function __construct(Seminar $seminar,ActivityLogInterface $activity_log_repo){
        $this->seminar = $seminar;
        $this->activity_log_repo = $activity_log_repo;
        parent::__construct();
    }



    public function test(){
        
        $other_db = $this->seminar->setConnection('mysql_external')->setTable('hr_employees');
        // $other_db = \DB::connection('mysql_external')->table('hr_employees');
        return $other_db->get();
    }

    public function fetch($request){

        $cache_key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $seminars = $this->cache->remember('seminars:fetch:' . $cache_key, 240, function() use ($request, $entries){

            $seminar = $this->seminar->newQuery();
            
            if(isset($request->q)){ $this->search($seminar, $request->q); }

            return $this->populate($seminar, $entries);

        });

        return $seminars;

    }





    public function store($request, $filename){

        $seminar = new Seminar;
        

        $seminar->seminar_id = $this->getSeminarIdInc();
        $seminar->slug = $this->str->random(16);
        $seminar->title = $request->title;
        $seminar->sponsor = $request->sponsor;
        $seminar->venue = $request->venue;
        $seminar->mill_district = $request->mill_district;
        $seminar->date_covered_from = $this->__dataType->date_parse($request->date_covered_from);
        $seminar->date_covered_to = $this->__dataType->date_parse($request->date_covered_to);
        $seminar->attendance_sheet_filename = $filename;
        $seminar->created_at = $this->carbon->now();
        $seminar->updated_at = $this->carbon->now();
        $seminar->ip_created = request()->ip();
        $seminar->ip_updated = request()->ip();
        $seminar->user_created = $this->auth->user()->user_id;
        $seminar->user_updated = $this->auth->user()->user_id;
        $seminar->save();
        
        //LOGGING
        $activity_log = collect();
        $activity_log->module = 'seminar';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $seminar->slug;
        $activity_log->remarks = "New data: ".$seminar->title;
        $this->activity_log_repo->store($activity_log);


        return $seminar;

    }





    public function update($request, $filename, $seminar){

        $seminar_old = $seminar->getOriginal();
        $seminar->title = $request->title;
        
        $seminar->sponsor = $request->sponsor;
        $seminar->venue = $request->venue;
        $seminar->mill_district = $request->mill_district;
        $seminar->date_covered_from = $this->__dataType->date_parse($request->date_covered_from);
        $seminar->date_covered_to = $this->__dataType->date_parse($request->date_covered_to);
        $seminar->attendance_sheet_filename = $filename;
        $seminar->project_code = $request->project_code;
        $seminar->utilized_fund = $request->utilized_fund;
        $seminar->updated_at = $this->carbon->now();
        $seminar->ip_updated = request()->ip();
        $seminar->user_updated = $this->auth->user()->user_id;
        $seminar->save();

        $seminar->seminarSpeaker()->delete();

        //LOGGING
        $activity_log = collect();
        $activity_log->module = 'seminar';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $seminar->slug;
        $activity_log->original = $seminar_old;
        $activity_log->obj = $seminar;
        $this->activity_log_repo->store($activity_log);


        return $seminar;

    }





    public function destroy($slug){

        $seminar = $this->findBySlug($slug);
        $seminar->delete();
        $seminar->seminarParticipant()->delete();
        $seminar->seminarSpeaker()->delete();

        //LOGGING
        $activity_log = collect();
        $activity_log->module = 'seminar';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $seminar->slug;
        $activity_log->remarks = "DELETED: ".$seminar->title;
        $this->activity_log_repo->store($activity_log);


        return $seminar;

    }


    public function fetchTable(){
        $get = $this->seminar;
        $get = $get->leftJoin('mill_district', 'mill_district.slug', '=', 'seminars.mill_district');

        $get = $get->get([
            'seminars.slug', 
            'seminars.seminar_id', 
            'seminars.title', 
            'mill_district.mill_district' , 
            'seminars.sponsor', 
            'seminars.venue', 
            'seminars.date_covered_from', 
            'seminars.date_covered_to'
        ]);
        return $get;
    }


    public function findBySlug($slug){

        $seminar = $this->seminar->where('slug', $slug)->first();
        
        if(empty($seminar)){ abort(404); }

        return $seminar;

    }






    private function getSeminarIdInc(){

        $id = 'S10001';
        $seminar = $this->seminar->select('seminar_id')->orderBy('seminar_id', 'desc')->first();

        if($seminar != null){
            $num = str_replace('S', '', $seminar->seminar_id) + 1;
            $id = 'S' . $num;
        }
        
        return $id;
        
    }






    private function search($instance, $key){

        return $instance->where(function ($instance) use ($key) {
                    $instance->where('title', 'LIKE', '%'. $key .'%')
                             ->orwhere('sponsor', 'LIKE', '%'. $key .'%')
                             ->orwhere('venue', 'LIKE', '%'. $key .'%');        
        });

    }





    private function populate($instance, $entries){

        return $instance->select('title', 'sponsor', 'venue', 'date_covered_from', 'date_covered_to', 'slug')
                        ->sortable()
                        ->orderBy('updated_at', 'desc')
                        ->paginate($entries);

    }






}