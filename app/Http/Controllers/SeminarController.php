<?php

namespace App\Http\Controllers;


use App\Core\Services\SeminarService;
use App\Http\Requests\Seminar\SeminarFormRequest;
use App\Http\Requests\Seminar\SeminarFilterRequest;

use App\Models\Seminar;

use App\Core\Services\SeminarParticipantService;
use App\Http\Requests\SeminarParticipant\SeminarParticipantCreateFormRequest;
use App\Http\Requests\SeminarParticipant\SeminarParticipantEditFormRequest;

use Datatables;



class SeminarController extends Controller{



	protected $seminar;
    protected $seminar_participant;



    public function __construct(SeminarService $seminar, SeminarParticipantService $seminar_participant){

        $this->seminar = $seminar;
        $this->seminar_participant = $seminar_participant;

    }


    
    public function index(){

        if(request()->ajax())
        {   

            return datatables()->of(Seminar::latest()->get(['id', 'slug', 'seminar_id', 'title', 'sponsor', 'venue', 'date_covered_from', 'date_covered_to']))
            ->addColumn('action', function($data){
                $button = '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm view_seminar_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#view_seminar_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Participants" data-placement="top">
                                    <i class="fa fa-users"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_seminar_btn" data-toggle="modal" data-target="#edit_seminar_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_seminar_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->setRowId('slug')
            ->make(true);
        }

        
        return view('dashboard.seminar.index');

    }

    public function seminarList(){


    }

    

    public function create(){
        
        return view('dashboard.seminar.create');

    }

   

    public function store(SeminarFormRequest $request){
        
        $validated = $request->validated();
        return $this->seminar->store($request);
        
    }
 



    public function edit($slug){
        
        return $this->seminar->edit($slug);
        // return $slug;
    }




    public function viewAttendanceSheet($slug){

       return $this->seminar->viewAttendanceSheet($slug); 

    }




    public function update(SeminarFormRequest $request, $slug){
        
        // return $this->seminar->update($request, $slug);
        // return $slug;
        $validated = $request->validated();
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

    public function viewSeminar($slug){
        return $this->seminar->view($slug);
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
