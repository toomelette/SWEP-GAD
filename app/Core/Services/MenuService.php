<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\MenuInterface;
use App\Core\Interfaces\SubmenuInterface;
use App\Core\BaseClasses\BaseService;


class MenuService extends BaseService{


    protected $menu_repo;
    protected $submenu_repo;



    public function __construct(MenuInterface $menu_repo, SubmenuInterface $submenu_repo){

        $this->menu_repo = $menu_repo;
        $this->submenu_repo = $submenu_repo;
        parent::__construct();

    }





    public function fetch($slug){

        return $this->menu_repo->fetch($slug);

    }

    public function fetchTable($data){

        return $this->menu_repo->fetchTable($data);

    }

    public function getAll(){
        return $this->menu_repo->getAll();
    }

    public function reorderMenus($array){
        $inc = 0;
        foreach ($array as $key => $value) {
            $inc++;

            $this->menu_repo->reorderMenus($value, $inc);
        }

        return $inc;
    }


    public function store($request){
       
        $menu = $this->menu_repo->store($request);

        return $menu;

    }






    public function edit($slug){

        $menu = $this->menu_repo->findbySlug($slug);
        return view('dashboard.menu.edit')->with('menu', $menu);

    }






    public function update($request , $slug){

        $menu = $this->menu_repo->update($request, $slug);
        return $menu;
    }






    public function destroy($slug){

        $menu = $this->menu_repo->destroy($slug);

        return $menu;

    }






}