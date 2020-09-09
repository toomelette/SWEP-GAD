<?php

namespace App\Core\Services;

use App\Core\Interfaces\BlockFarmInterface;
use App\Core\Interfaces\BlockFarmProblemInterface;
use App\Core\Interfaces\BFEncounteredProblemInterface;
use App\Core\BaseClasses\BaseService;




class BlockFarmService extends BaseService{


	protected $block_farm_repo;
    protected $bf_encountered_repo;
    protected $block_farm_problem_repo;
	public function __construct(BlockFarmInterface $block_farm_repo,BFEncounteredProblemInterface $bf_encountered_repo, BlockFarmProblemInterface $block_farm_problem_repo){

        $this->block_farm_repo = $block_farm_repo;
        $this->bf_encountered_repo = $bf_encountered_repo;
        $this->block_farm_problem_repo = $block_farm_problem_repo;
        parent::__construct();

    }

    
    public function store($request){
    	$block_farm = $this->block_farm_repo->store($request);
        $block_farm_slug = $block_farm->slug;
        if(!empty($request->problem)){
            foreach ($request->problem as $key => $problem_slug) {
                $this->bf_encountered_repo->store($problem_slug, $block_farm_slug);
            }
        }

        return $block_farm;
    }

    public function show($slug){
        $block_farm = $this->block_farm_repo->findBySlug($slug);
        

        return view("dashboard.block_farm.show")->with("block_farm",$block_farm);
    }

    public function edit($slug){
        $block_farm = $this->block_farm_repo->findBySlug($slug);
        $all_problems = $this->block_farm_problem_repo->fetch();
        return view("dashboard.block_farm.edit")->with(["block_farm"=>$block_farm,"all_problems"=> $all_problems]);
    }

    public function update($request, $slug){
        $block_farm = $this->block_farm_repo->update($request, $slug);
        if(!empty($request->problem)){
            foreach ($request->problem as $key => $problem_slug) {
                $this->bf_encountered_repo->store($problem_slug, $slug);
            }
        }
        return $block_farm;
    }

    public function destroy($slug){
        return $this->block_farm_repo->destroy($slug);
    }
    
    public function fetchTable($data){
        return $this->block_farm_repo->fetchTable($data);
    }

    public function list($query){
        return $this->block_farm_repo->list($query);
    }
    // public function __construct(BlockFarmInterface $block_farm_repo){
    //     $this->block_farm_repo = $block_farm_repo;
    //     parent::__construct();
    // }

    public function get($slug){
        return $this->block_farm_repo->findBySlug($slug);
    }

    public function members($slug){
        return $slug;
    }


    public function getRaw(){
        return $this->block_farm_repo->getRaw();

    }
    
}