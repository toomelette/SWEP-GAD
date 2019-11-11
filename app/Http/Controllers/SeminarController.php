<?php

namespace App\Http\Controllers;

use App\Core\Services\SeminarService;
use App\Http\Requests\Seminar\SeminarFormRequest;
use App\Http\Requests\Seminar\SeminarFilterRequest;

class SeminarController extends Controller{



	protected $seminar;



    public function __construct(SeminarService $seminar){

        $this->seminar = $seminar;

    }


    
    // public function index(SeminarFilterRequest $request){
        
    //     return $this->seminar->fetch($request);

    // }

    

    public function create(){
        
        return view('dashboard.seminar.create');

    }

   

    public function store(SeminarFormRequest $request){
        
        return $this->seminar->store($request);

    }
 



    // public function edit($slug){
        
    //     return $this->seminar->edit($slug);

    // }




    // public function update(SeminarFormRequest $request, $slug){
        
    //     return $this->seminar->update($request, $slug);

    // }

    


    // public function destroy($slug){
        
    //     return $this->seminar->destroy($slug);

    // }




    
}
