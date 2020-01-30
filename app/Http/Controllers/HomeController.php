<?php

namespace App\Http\Controllers;


use App\Core\Services\HomeService;



class HomeController extends Controller{
    



	protected $home;




    public function __construct(HomeService $home){

        $this->home = $home;

    }





    public function index(){
    	$scholars = $this->home->scholars();

    	return view('dashboard.home.index')->with([
    		'scholars'=>[
    			"male" => $scholars->male,
    			"female" => $scholars->female,
    			"total" => $scholars->male + $scholars->female
    		]
    	]);

    }
    





}
