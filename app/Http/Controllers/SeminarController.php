<?php

namespace App\Http\Controllers;


use App\Core\Services\SeminarService;
use App\Core\Services\SeminarParticipantService;
use App\Http\Requests\Seminar\SeminarFormRequest;
use App\Http\Requests\Seminar\SeminarFilterRequest;
use App\Http\Requests\SeminarParticipant\SeminarParticipantCreateFormRequest;
use App\Http\Requests\SeminarParticipant\SeminarParticipantEditFormRequest;
use App\Core\Services\MillDistrictService;
use Illuminate\Http\Request;
use Datatables;



class SeminarController extends Controller{

	protected $seminar;
    protected $seminar_participant;
    protected $mill_district;

    public function __construct(SeminarService $seminar, SeminarParticipantService $seminar_participant, MillDistrictService $mill_district){
        
        $this->seminar = $seminar;
        $this->seminar_participant = $seminar_participant;
        $this->mill_district = $mill_district;
    }
    
    public function index(){
            
        //return $this->seminar->test();

        if(request()->ajax())
        {   
            
            return datatables()->of($this->seminar->fetchTable())
            ->addColumn('action', function($data){

                $user = auth()->user();
                $have_access_to = [];
                foreach ($user->userSubmenu as $userSubmenu) {
                    if(!empty($userSubmenu->subMenu)){
                        $have_access_to[$userSubmenu->subMenu->route]="";
                    } 
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
            ->editColumn('date_covered', function($data){
               if($data->date_covered_from == $data->date_covered_to ){
                return date("M. d, Y",strtotime($data->date_covered_from));
               }else{
                return date("M. d, Y",strtotime($data->date_covered_from)).' - '.date("M. d, Y",strtotime($data->date_covered_to));
               }
            })
            ->rawColumns(['action'])
            ->setRowId('slug')
            ->make();
        }

        return view('dashboard.seminar.index')->with([
            'mill_districts_list' => $this->mill_district->mills(),
        ]);
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

        return view('dashboard.seminar.show')->with([
            'seminar'=>$seminar, 
            'file_details'=> $file_details
        ]);
    }



    public function edit($slug){
        
        $seminar = $this->seminar->edit($slug);
        return view('dashboard.seminar.edit')->with([
            'seminar'=>$seminar,
            'mill_districts_list' => $this->mill_district->mills()
        ]);
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

    public function participantEdit(Request $request){
        $slug = $request->slug;
        $participant = $this->seminar_participant->edit($slug);
        return view("dashboard.seminar.edit_participant")->with([
            'participant' => $participant
        ]);
    }


    public function participantStore(SeminarParticipantCreateFormRequest $request, $slug){

        $participant = $this->seminar_participant->store($request, $slug);
        $participant->sex = $this->sex($participant->sex);

        return $participant;

    }




    public function participantUpdate(SeminarParticipantCreateFormRequest $request, $sem_slug){

        $participant = $this->seminar_participant->update($request, $sem_slug); 
        $participant->sex = $this->sex($participant->sex);

        return $participant;
    } 




    public function participantDestroy($slug){
        
        return $this->seminar_participant->destroy($slug);

    }





    /** Seminar participant **/

    public function speaker($slug){

        return $slug;

    }

    
    public function sex($sex){
        if($sex == "MALE"){
            return '<span class="label bg-green col-md-12"><i class="fa fa-male"></i> MALE</span>';
        }if($sex == "FEMALE"){
            return '<span class="label bg-maroon col-md-12"><i class="fa fa-female"></i> FEMALE</span>';
        }
    }
    
}
