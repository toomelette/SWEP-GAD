<?php

namespace App\Core\Services;

use App\Core\Interfaces\BFMemberInterface;
use App\Core\Interfaces\BFMemberFamilyInterface;
use App\Core\Interfaces\BlockFarmInterface;
//use App\Core\Interfaces\BFEncounteredProblemInterface;
use App\Core\BaseClasses\BaseService;




class BFMemberService extends BaseService{

    protected $bf_member_repo;
    protected $block_farm_repo;
	protected $bf_family_repo;

	public function __construct(BFMemberInterface $bf_member_repo,BlockFarmInterface $block_farm_repo,BFMemberFamilyInterface $bf_family_repo){

        $this->bf_member_repo = $bf_member_repo;
        $this->block_farm_repo = $block_farm_repo;
        $this->bf_family_repo = $bf_family_repo;
        parent::__construct();

    }

    
    public function store($request){

    
        $block_farm_repo = $this->block_farm_repo->findBySlug($request->chosen_bf);

        if(empty($block_farm_repo)){
            abort(404);
        }
        $bf_member = $this->bf_member_repo->store($request);

        if(!empty($request->family_members)){
            foreach ($request->family_members as $key => $member) {
                $member_collection = collect();
                foreach ($member as $name => $value) {
                    $member_collection->$name = $value;
                    $member_collection->bf_member = $bf_member->slug;
                }
                $this->bf_family_repo->store($member_collection);
            }
        }
    	
        return $bf_member;
    }

    public function show($slug){
        $bf_member = $this->bf_member_repo->findBySlug($slug);
        return $bf_member;
    }

    public function edit($slug){
        $bf_member = $this->bf_member_repo->findBySlug($slug);
        return $bf_member;
    }

    public function update($request, $slug){

        $block_farm_repo = $this->block_farm_repo->findBySlug($request->chosen_bf);

        if(empty($block_farm_repo)){
            abort(404);
        }


        $bf_member = $this->bf_member_repo->update($request, $slug);
        $bf_member->familyMembers()->delete();

        if(!empty($request->family_members)){
            foreach ($request->family_members as $key => $member) {
                $member_collection = collect();
                foreach ($member as $name => $value) {
                    $member_collection->$name = $value;
                    $member_collection->bf_member = $bf_member->slug;
                }
                $this->bf_family_repo->store($member_collection);
            }
        }

        

        return $bf_member;
    }

    public function destroy($slug){
        $bf_member = $this->bf_member_repo->destroy($slug);
        $bf_member->familyMembers()->delete();
        return $bf_member;
    }
    
    public function fetchTable($data){
       return $this->bf_member_repo->fetchTable($data);
    }


}