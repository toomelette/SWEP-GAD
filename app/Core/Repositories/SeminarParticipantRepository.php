<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SeminarParticipantInterface;
use App\Core\Interfaces\SeminarInterface;

use App\Models\SeminarParticipant;


class SeminarParticipantRepository extends BaseRepository implements SeminarParticipantInterface {
	



    protected $seminar_participant;
    protected $seminar_repo;




	public function __construct(SeminarParticipant $seminar_participant, SeminarInterface $seminar_repo){

        $this->seminar_participant = $seminar_participant;
        $this->seminar_repo = $seminar_repo;
        parent::__construct();

    }






    public function fetchBySeminarId($slug){

        $seminar = $this->seminar_repo->findBySlug($slug);

        return $seminar_participant;

    }


    public function store($request, $slug){

        $seminar = $this->seminar_repo->findBySlug($slug);

        $seminar_participant = new SeminarParticipant;
        $seminar_participant->slug = $this->str->random(32);
        $seminar_participant->seminar_id = $seminar->seminar_id;
        $seminar_participant->seminar_participant_id = $this->getSeminarParticipantIdInc();

        $seminar_participant->fullname = $request->fullname;
        $seminar_participant->occupation = $request->occupation;
        $seminar_participant->age = $request->age;
        $seminar_participant->sex = $request->sex;
        $seminar_participant->civil_status = $request->civil_status;
        $seminar_participant->educ_att = $request->educ_att;
        $seminar_participant->contact_no = $request->contact_no;
        $seminar_participant->no_children = $request->no_children;
        
        $seminar_participant->created_at = $this->carbon->now();
        $seminar_participant->updated_at = $this->carbon->now();
        $seminar_participant->ip_created = request()->ip();
        $seminar_participant->ip_updated = request()->ip();
        $seminar_participant->user_created = $this->auth->user()->user_id;
        $seminar_participant->user_updated = $this->auth->user()->user_id;
        $seminar_participant->save();

        return $seminar_participant;
    }






    public function update($request, $sem_ptcpt_slug){
        
        $seminar_participant = $this->findBySlug($sem_ptcpt_slug);

        $seminar_participant->fullname = $request->fullname;
        $seminar_participant->occupation = $request->occupation;
        $seminar_participant->age = $request->age;
        $seminar_participant->sex = $request->sex;
        $seminar_participant->civil_status = $request->civil_status;
        $seminar_participant->educ_att = $request->educ_att;
        $seminar_participant->contact_no = $request->contact_no;
        $seminar_participant->no_children = $request->no_children;

        $seminar_participant->updated_at = $this->carbon->now();
        $seminar_participant->ip_updated = request()->ip();
        $seminar_participant->user_updated = $this->auth->user()->user_id;
        $seminar_participant->save();

        return $seminar_participant;

    }






    public function destroy($slug){

        $seminar_participant = $this->findBySlug($slug);
        $seminar_participant->delete();

        return $seminar_participant;

    }






    public function findBySlug($slug){
            
        $seminar_participant = $this->seminar_participant->where('slug', $slug)->first();

        if(empty($seminar_participant)){
            abort(404);
        }

        return $seminar_participant;

    }





    public function getBySlug($slug){
            
        return $seminar_participant;

    }







    public function populateBySeminarId($instance, $seminar_id){

        return $instance->where('seminar_id', $seminar_id)
                        ->orderBy('updated_at', 'desc')
                        ->get();

    }






    private function getSeminarParticipantIdInc(){

        $id = 'SP100001';
        $seminar_participant = $this->seminar_participant->select('seminar_participant_id')->orderBy('seminar_participant_id', 'desc')->first();

        if($seminar_participant != null){
            $num = str_replace('SP', '', $seminar_participant->seminar_participant_id) + 1;
            $id = 'SP' . $num;
        }
        
        return $id;
        
    }





    






}