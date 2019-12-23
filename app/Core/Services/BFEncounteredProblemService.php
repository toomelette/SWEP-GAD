<?php

namespace App\Core\Services;

use App\Core\Interfaces\BFEncounteredProblemInterface;
// use App\Core\Interfaces\BlockFarmProblemInterface;
use App\Core\BaseClasses\BaseService;




class BFEncounteredProblemService extends BaseService{


	protected $block_farm_repo;

	public function __construct(BFEncounteredProblemInterface $bf_encountered_repo){

        $this->bf_encountered_repo = $bf_encountered_repo;

        parent::__construct();

    }

    
    public function store($problem_slug, $block_farm_slug){

    	return $this->bf_encountered_repo->store($problem_slug, $block_farm_slug);

    }

    

    // public function __construct(BlockFarmInterface $block_farm_repo){
    //     $this->block_farm_repo = $block_farm_repo;
    //     parent::__construct();
    // }

}