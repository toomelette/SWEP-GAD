<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\ScholarsInterface;
use App\Core\BaseClasses\BaseService;


class ScholarsService extends BaseService{


    protected $scholars_repo;




    public function __construct(ScholarsInterface $scholars_repo){

        $this->scholars_repo = $scholars_repo;

        parent::__construct();

    }





    public function fetch($request){

    

    }

    public function fetchTable(){

        return $this->scholars_repo->fetchTable();

    }




    public function store($request){
        $scholars = $this->scholars_repo->store($request);
        return $scholars;

    }






    public function show($slug){

        $scholars = $this->scholars_repo->findBySlug($slug);


        $age = 0;
        $birth = date("Y-m-d",strtotime($scholars->birth));

        while ($birth <= date( "Y-m-d",strtotime( now() ) ) ) {
            
            $birth = date("Y-m-d",strtotime($birth."+ 1 year"));
            $age++;
        }

        $scholars->age = $age-1;
        return view('dashboard.scholars.show')->with([ 'scholars' => $scholars]);
    }


    public function edit($slug){

        $scholars = $this->scholars_repo->findBySlug($slug);
        return view('dashboard.scholars.edit')->with(['scholars'=>$scholars]);

    }



    public function update($request, $slug){

        return $this->scholars_repo->update($request,$slug);

    }








    public function destroy($slug){

        $scholars = $this->scholars_repo->destroy($slug);
        return $scholars;
    }






}