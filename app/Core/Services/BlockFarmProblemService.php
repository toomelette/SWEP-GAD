<?php

namespace App\Core\Services;

use App\Core\Interfaces\BlockFarmProblemInterface;
use App\Core\BaseClasses\BaseService;




class BlockFarmProblemService extends BaseService{


	protected $block_farm_problem_repo;

	public function __construct(BlockFarmProblemInterface $block_farm_problem_repo){

        $this->block_farm_problem_repo = $block_farm_problem_repo;

        parent::__construct();

    }

    public function fetch()
    {
    	//$data = [1 => 'a', 2=> 'b', 3 => 'c'];
        $data =  $this->block_farm_problem_repo->fetch();
        return $data;
    }



    // public function __construct(BlockFarmInterface $block_farm_repo){
    //     $this->block_farm_repo = $block_farm_repo;
    //     parent::__construct();
    // }

}