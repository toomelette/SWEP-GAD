<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\TempInterface;


use App\Models\Temp;


class TempRepository extends BaseRepository implements TempInterface {
	



    protected $temp;




	public function __construct(Temp $temp){

        $this->temp = $temp;
        parent::__construct();

    }


    public function fetch()
    {
        return $this->temp->get();
    }



    public function store($request){


       

    }






    public function findBySubmenuId($submenu_id){


    }

    public function findBySlug($slug){
       
    }






    public function getAll(){



    }






    public function getByMenuId($menu_id){

        // $submenu = $this->cache->remember('submenus:getByMenuId:'. $menu_id .'', 240, function() use ($menu_id){

        //     return $this->submenu->select('submenu_id', 'name')
        //                          ->where('menu_id', $menu_id)
        //                          ->orderBy('submenu_id', 'asc')
        //                          ->get();

        // });

        // return $submenu;

    }



    public function edit($slug){
    }
    
    public function update($request, $id){
        $temp = $this->getById($id);
        $temp->No = $request->slug;
        $temp->save();
        return $temp;
    }   

    public function destroy($slug){

    }


    public function getById($id)
    {
        return $this->temp->where('Total_No','=',$id)->get()->first();
    }


}