<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\UserInterface;
use App\Core\Interfaces\ScholarsInterface;
use App\Core\BaseClasses\BaseService;



class HomeService extends BaseService{



    protected $user_repo;
    protected $scholar_repo;


    public function __construct(UserInterface $user_repo,ScholarsInterface $scholar_repo){

        $this->user_repo = $user_repo;
        $this->scholar_repo = $scholar_repo;
        parent::__construct();

    }





    public function view(){

        
    }



    public function scholars(){
    	$scholars = collect();
    	$scholars->male= $this->scholar_repo->all_male()->count();
    	$scholars->female= $this->scholar_repo->all_female()->count();
    	return $scholars;
    }




}