<?php
 
namespace App\Core\Services;



use App\Core\Interfaces\SubmenuInterface;
use App\Core\Interfaces\MenuInterface;
use App\Core\BaseClasses\BaseService;


class SubmenuService extends BaseService{


    protected $submenu_repo;
    protected $menu_repo;


    public function __construct(SubmenuInterface $submenu_repo, MenuInterface $menu_repo){

        $this->submenu_repo = $submenu_repo;
        $this->menu_repo = $menu_repo;
        parent::__construct();

    }





    public function fetch($request){



    }

    public function fetchTable(){



    }

    public function getAll(){
   
    }


    public function store($request){
        $menu = $this->menu_repo->fetch($request->menu);
        $request->menu = $menu->menu_id;
        return $this->submenu_repo->store($request);

    }


    public function edit($slug){

        $submenu = $this->submenu_repo->findBySlug($slug);
        return $submenu;
    }






    public function update($request, $slug){

        $submenu = $this->submenu_repo->update($request, $slug);
        return $submenu;
    }






    public function destroy($slug){
        return $this->submenu_repo->destroy($slug);
    }






}