<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\CommitteeMembersInterface;

use App\Core\Interfaces\ActivityLogInterface;
use App\Models\CommitteeMembers;


class CommitteeMembersRepository extends BaseRepository implements CommitteeMembersInterface {
	


    protected $committee_members;
    protected $activity_log_repo;


	public function __construct(CommitteeMembers $committee_members,ActivityLogInterface $activity_log_repo){

        $this->committee_members = $committee_members;
        $this->activity_log_repo = $activity_log_repo;
        parent::__construct();

    }





    public function fetch($request){

       
    }


    public function fetchTable($data){
        $get = $this->committee_members;
        
        // if(!empty($data->sex)){
        //     switch ($data->sex) {
        //         case '':
        //             $get = $get;
        //             break;
        //         case 'MALE':
        //             $get = $get->where("sex","=","MALE");
        //             break;
        //         case 'FEMALE':
        //             $get = $get->where("sex","=","FEMALE");
        //             break;
        //         default:
        //             # code...
        //             break;
        //     }
        // }

        // if(!empty($data->scholarship_type)){
        //     switch ($data->scholarship_type) {
        //         case 'TESDA':
        //             $get = $get->where("scholarship_applied","=","TESDA");
        //             break;
        //         case 'CHED':
        //             $get = $get->where("scholarship_applied","=","CHED");
        //             break;
        //         case 'SRA':
        //             $get = $get->where("scholarship_applied","=","SRA");
        //             break;
        //         default:
        //             $get = $get;
        //             break;
        //     }
        // }
        // if(!empty($data->mill_district)){
        //     $get = $get->where('mill_district.slug','=',$data->mill_district);
        // }

        // if(!empty($data->course)){
        //     $get = $get->where('course_applied','=',$data->course);
        // }


        
       
        return $get->latest()->get();
    }

    public function fetchEmployees($query){

        $committee_members = $this->committee_members->setConnection('mysql_external')->setTable('hr_employees');

        $committee_members = $committee_members
        ->where('lastname','like','%'.$query.'%')
        ->orWhere('firstname','like','%'.$query.'%')
        ->orWhere('middlename','like','%'.$query.'%')
        ->get();
        ;
        
        $list = [];

        foreach ($committee_members as $key => $committee_member) {
            array_push($list, 
                [
                    'id'=> $committee_member['slug'],
                    'name' => 
                    ucwords(strtolower($committee_member['lastname']))
                    . ", ". 
                    ucwords(strtolower($committee_member['firstname'])) ." "
                    .ucfirst(substr($committee_member['middlename'], 0, 1))
                ]
            );
        }
        
        return  $list;
    }

    public function findEmployee($slug){
        $committee_members = $this->committee_members->setConnection('mysql_external')->setTable('hr_employees');

        $committee_members = $committee_members->where('slug','=', $slug)->get(['slug','lastname','firstname','middlename','sex'])->first();

        $committee_members->lastname = ucwords(strtolower($committee_members->lastname));

        $committee_members->firstname = ucwords(strtolower($committee_members->firstname));

        $committee_members->middlename = ucfirst(strtolower($committee_members->middlename));


        if($committee_members->sex == "M"){
            $committee_members->sex = "MALE";
        }

        if($committee_members->sex == "F"){
            $committee_members->sex = "FEMALE";
        }
        
        return $committee_members;
    }

    public function store($request){

        $committee_members = New CommitteeMembers;
        $committee_members->slug = $this->str->random(32);

        $committee_members->lname = $request->lname;
        $committee_members->fname = $request->fname;
        $committee_members->mname = $request->mname;
        $committee_members->sex = $request->sex;
        $committee_members->based_on = $request->based_on;
        $committee_members->is_active = $request->is_active;
        $committee_members->slug_afd = $request->slug_afd;

        $committee_members->created_at = $this->carbon->now();
        $committee_members->updated_at = $this->carbon->now();
        $committee_members->ip_created = request()->ip();
        $committee_members->ip_updated = request()->ip();
        $committee_members->user_created = $this->auth->user()->user_id;
        $committee_members->user_updated = $this->auth->user()->user_id;

        $committee_members->save();

        // //LOGGING
        $activity_log = collect();
        $activity_log->module = 'committee_members';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $committee_members->slug;
        $activity_log->remarks = "New data: "
                                .$committee_members->lname. ", ".$committee_members->fname;
        $this->activity_log_repo->store($activity_log);


        return $committee_members;
    }





    public function update($request, $slug){

        $committee_members = $this->findBySlug($slug);

        $committee_members_old = $committee_members->getOriginal();

        $committee_members->lname = $request->lname;
        $committee_members->fname = $request->fname;
        $committee_members->mname = $request->mname;
        $committee_members->sex = $request->sex;
        $committee_members->based_on = $request->based_on;
        $committee_members->is_active = $request->is_active;
        $committee_members->updated_at = $this->carbon->now();
        $committee_members->ip_updated = request()->ip();
        $committee_members->user_updated = $this->auth->user()->user_id;
        $committee_members->save();

        //LOGGING
        $activity_log = collect();
        $activity_log->module = 'committee_members';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $committee_members->slug;
        $activity_log->original = $committee_members_old;
        $activity_log->obj = $committee_members;
        $this->activity_log_repo->store($activity_log);
        
        return $committee_members;

    }





    public function destroy($slug){

        $committee_members = $this->findBySlug($slug);
        $committee_members->delete();

        //LOGGING
        $activity_log = collect();
        $activity_log->module = 'committee_members';
        $activity_log->event = __FUNCTION__;
        $activity_log->slug = $committee_members->slug;
        $activity_log->remarks = "DELETED: "
                                .$committee_members->lastname. ", "
                                .$committee_members->firstname;
        $this->activity_log_repo->store($activity_log);

        return $committee_members;

    }





    public function findBySlug($slug){

        $committee_member = $this->committee_members->where('slug', '=',$slug)->first();

        return $committee_member;
    }






 






    public function getAll(){


    }





   






    private function search($instance, $key){



    }





    private function populate($instance, $entries){


    }



    

    public function getRaw(){
        return $this->scholars;
    }
}