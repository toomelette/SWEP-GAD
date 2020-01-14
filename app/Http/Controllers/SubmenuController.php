<?php

namespace App\Http\Controllers;


use App\Core\Services\SubmenuService;
use App\Core\Services\MenuService;
use App\Http\Requests\Submenu\SubmenuFormRequest;
use Illuminate\Http\Request;



class SubmenuController extends Controller{


    protected $submenu;
    protected $menu;


    public function __construct(SubmenuService $submenu, MenuService $menu){

        $this->submenu = $submenu;
        $this->menu = $menu;
    }


    
    public function index(Request $menu_slug){
        $menu_slug = $menu_slug->get('menu_slug');
        $menu = $this->menu->fetch($menu_slug);
        return view("dashboard.submenu.index")->with(['menu'=>$menu]);
    }






    public function create(){
        
       
    }

   

    public function store(SubmenuFormRequest $request){

        $submenu = $this->submenu->store($request);
        return $submenu;

    }
 



    public function edit($slug){
        
     return $this->submenu->edit($slug);

    }




    public function update(SubmenuFormRequest $request, $slug){
        
       return $this->submenu->update($request, $slug);

    }

    


    public function destroy($slug){
        
       return $this->submenu->destroy($slug);

    }



    
}
