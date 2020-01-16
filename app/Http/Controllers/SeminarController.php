<?php

namespace App\Http\Controllers;


use App\Core\Services\SeminarService;
use App\Core\Services\SeminarParticipantService;
use App\Http\Requests\Seminar\SeminarFormRequest;
use App\Http\Requests\Seminar\SeminarFilterRequest;
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
    
            return datatables()->of($this->seminar->fetchTable())
            ->addColumn('action', function($data){
                $user = auth()->user();
                $have_access_to = [];
                foreach ($user->userSubmenu as $userSubmenu) {
                    $have_access_to[$userSubmenu->subMenu->route]="";
                }


                $button = '<div class="btn-group">';

                if(isset($have_access_to["dashboard.seminar.show"])){
                    $button = $button.
                            '<button type="button" class="btn btn-default btn-sm view_seminar_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#view_seminar_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                            </button>';
                }

                if(isset($have_access_to["dashboard.seminar.participant"])){
                    $button = $button.
                            '<button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm participant_btn" data-toggle="modal" data-target="#participant_modal" title="Participants" data-placement="top">
                                   <i class="fa fa-users"></i>
                            </button>';
                }

                if(isset($have_access_to["dashboard.seminar.edit"])){
                    $button = $button.
                            '<button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_seminar_btn" data-toggle="modal" data-target="#edit_seminar_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                            </button>';
                }

                if(isset($have_access_to["dashboard.seminar.destroy"])){
                    $button = $button.
                            '<button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_seminar_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                            </button>';
                }
                $button =  $button.'</div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->setRowId('slug')
            ->make();
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
    

    public function show($slug){
        $seminar = $this->seminar->show($slug);
        $file_details = $this->seminar->getFileDetails($slug);

        return view('dashboard.seminar.show')->with(['seminar'=>$seminar, 'file_details'=> $file_details]);
    }



    public function edit($slug){
        
        $seminar = $this->seminar->edit($slug);
        return view('dashboard.seminar.edit')->with(['seminar'=>$seminar]);
    }




    public function viewAttendanceSheet($slug){

       return $this->seminar->viewAttendanceSheet($slug); 

    }

    public function downloadAttendanceSheet($slug){

        return $this->seminar->downloadAttendanceSheet($slug); 

    }


    public function update(SeminarFormRequest $request, $slug){
        
        $validated = $request->validated();
        return $this->seminar->update($request, $slug);

    }

    


    public function destroy($slug){

        return $this->seminar->destroy($slug);

    }



    /** Seminar participant **/
    public function participant($slug){

        $seminar = $this->seminar->participant($slug);

        return view('dashboard.seminar.participants')->with(['seminar' => $seminar]);

    }

    public function participantEdit($slug){
 
        return $this->seminar_participant->edit($slug);

    }


    public function participantStore(SeminarParticipantCreateFormRequest $request, $slug){

        return $this->seminar_participant->store($request, $slug);

    }




    public function participantUpdate(SeminarParticipantEditFormRequest $request, $sem_slug){
        
        return $this->seminar_participant->update($request, $sem_slug); 

    } 




    public function participantDestroy($slug){
        
        return $this->seminar_participant->destroy($slug);

    }





    /** Seminar participant **/

    public function speaker($slug){

        return $slug;

    }

    

    
}
