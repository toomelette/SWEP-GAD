<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\CommitteeMembersInterface;

use App\Core\BaseClasses\BaseService;


class CommitteeMembersService extends BaseService{


    protected $committee_members_repo;




    public function __construct(CommitteeMembersInterface $committee_members_repo){

        $this->committee_members_repo = $committee_members_repo;
    
        parent::__construct();

    }

   


    public function fetch($request){

    

    }

    public function fetchTable($data){
        $committee_members = $this->committee_members_repo->fetchTable($data);

        return $committee_members;
    }

    public function fetchEmployees($query){
        return $this->committee_members_repo->fetchEmployees($query);
    }


    public function store($request){
        $committee_members = $this->committee_members_repo->store($request);
        return $committee_members;
    }


    public function findEmployee($slug){
        $committee_members = $this->committee_members_repo->findEmployee($slug);
        return $committee_members;
    }


    public function show($slug){
        $committee_member = $this->committee_members_repo->findBySlug($slug);
        return $committee_member;
        
    }


    public function edit($slug){

        $committee_member = $this->committee_members_repo->findBySlug($slug);
        return $committee_member;

    }



    public function update($request, $slug){
       $committee_member = $this->committee_members_repo->update($request, $slug);
        return $committee_member;
       
    }








    public function destroy($slug){
        $committee_member = $this->committee_members_repo->destroy($slug);
        return $committee_member;
       
    }


    public function getRaw(){
     
    }

    



}