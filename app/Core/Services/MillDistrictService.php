<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\MillDistrictInterface;
// use App\Core\Interfaces\SubmenuInterface;
use App\Core\BaseClasses\BaseService;


class MillDistrictService extends BaseService{


    protected $mill_district_repo;
    // protected $submenu_repo;



    public function __construct(MillDistrictInterface $mill_district_repo){

        $this->mill_district_repo = $mill_district_repo;
        // $this->submenu_repo = $submenu_repo;
        parent::__construct();

    }





    public function fetch($slug){

        return 'fetch';

    }

     public function fetchAll(){

        return $mill_district = $this->mill_district_repo->fetchAll();
     
    }

    public function fetchTable($data){

        return $this->mill_district_repo->fetchTable($data);

    }




    public function store($request){
       
        return $this->mill_district_repo->store($request);

    }






    public function edit($slug){

        return $this->mill_district_repo->findBySlug($slug);

    }






    public function update($request , $slug){

        return $this->mill_district_repo->update($request , $slug);
    }






    public function destroy($slug){

         return $this->mill_district_repo->destroy($slug);

    }






}