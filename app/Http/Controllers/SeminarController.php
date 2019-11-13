<?php

namespace App\Http\Controllers;

use App\Core\Services\SeminarService;
use App\Http\Requests\Seminar\SeminarFormRequest;
use App\Http\Requests\Seminar\SeminarFilterRequest;

use App\Core\Services\SeminarParticipantService;
use App\Http\Requests\SeminarParticipant\SeminarParticipantCreateFormRequest;
use App\Http\Requests\SeminarParticipant\SeminarParticipantEditFormRequest;

class SeminarController extends Controller{



	protected $seminar;
    protected $seminar_participant;



    public function __construct(SeminarService $seminar, SeminarParticipantService $seminar_participant){

        $this->seminar = $seminar;
        $this->seminar_participant = $seminar_participant;

    }


    
    public function index(SeminarFilterRequest $request){
        
        return $this->seminar->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.seminar.create');

    }

   

    public function store(SeminarFormRequest $request){
        
        return $this->seminar->store($request);

    }
 



    public function edit($slug){
        
        return $this->seminar->edit($slug);

    }




    public function viewAttendanceSheet($slug){

       return $this->seminar->viewAttendanceSheet($slug); 

    }




    public function update(SeminarFormRequest $request, $slug){
        
        return $this->seminar->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->seminar->destroy($slug);

    }





    /** Seminar participant **/

    public function participant($slug){

        return $this->seminar_participant->index($slug);

    }




    public function participantStore(SeminarParticipantCreateFormRequest $request, $slug){

        return $this->seminar_participant->store($request, $slug);

    }




    public function participantUpdate(SeminarParticipantEditFormRequest $request, $sem_slug, $sem_ptcpt_slug){
        
        return $this->seminar_participant->update($request, $sem_slug, $sem_ptcpt_slug); 

    } 




    public function participantDestroy($slug){
        
        return $this->seminar_participant->destroy($slug);

    }





    /** Seminar participant **/

    public function speaker($slug){

        return $slug;

    }




    // public function participantStore(SeminarParticipantCreateFormRequest $request, $slug){

    //     return $this->seminar_participant->store($request, $slug);

    // }




    // public function participantUpdate(SeminarParticipantEditFormRequest $request, $sem_slug, $sem_ptcpt_slug){
        
    //     return $this->seminar_participant->update($request, $sem_slug, $sem_ptcpt_slug); 

    // } 




    // public function participantDestroy($slug){
        
    //     return $this->seminar_participant->destroy($slug);

    // }




    
}
