<?php

namespace App\Http\Controllers;


use App\Core\Services\CommitteeMembersService;
//use App\Core\Services\MillDistrictService;
//use App\Http\Requests\CommitteeMembers\CommitteeMembersFormRequest;
use Yajra\DataTables\Html\Builder;
//use Illuminate\Http\Request;



class OfficeActivitiesController extends Controller{


    protected $committee_members;

    public function __construct(CommitteeMembersService $committee_members){

        $this->committee_members = $committee_members;
    
    }


    
    public function index(Builder $builder){
        $html = $builder->parameters([
            'rowGroup'=> [
                'dataSrc' => ['mill_district']
            ]
        ]);
        $request = request();


        if(request()->ajax()){   
            if(!empty($request->draw)){
                $data = request();
            
                return datatables()->of($this->committee_members->fetchTable($data))
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm show_committe_member_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_committee_member_modal" title="View more" data-placement="left">
                                        <i class="fa fa-file-text"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_committee_member_btn" data-toggle="modal" data-target="#edit_committee_member_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_committee_member_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>';
                    return $button;
                })->editColumn('fullname',function($data){
                    $fullname = ucfirst($data->lname).", " .ucfirst($data->fname)." ";

                    if($data->mname != ""){
                        $fullname = $fullname.ucfirst(substr($data->mname,0, 1)).".";
                    }
                    return $fullname;
           
                      ;
                })->editColumn('sex',function($data){
                    if($data->sex == "MALE"){
                        return '<span class="label bg-green col-md-12"><i class="fa fa-male"></i> '.$data->sex.'</span>';
                    }elseif($data->sex == "FEMALE"){
                        return '<span class="label bg-maroon col-md-12"><i class="fa fa-female"></i> '.$data->sex.'</span>';
                    }else{
                        return $data->sex;
                    }
                    
                })

                
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
            }


            if(!empty($request->get('query'))){
                $query = $request->get('query');
                return $this->committee_members->fetchEmployees($query);
            }

            if(!empty($request->get('find_employee'))){
                $employee_slug = $request->get('find_employee');
                $committee_members = $this->committee_members->findEmployee($employee_slug);
                return $committee_members;
            }
        }


        
    

        
        $search = '';
        if(!empty(request()->get('search'))){
            $search = request()->get('search');
        }


        return view('dashboard.office_activities.index', compact('html'))->with([


            'search' => $search
        ]);





    }

    public function store(CommitteeMembersFormRequest $request){
        $committee_members = $this->committee_members->store($request);
        return $committee_members;
    }


    public function create(){
        

    }



    public function show($slug){
        $committee_member = $this->committee_members->show($slug);
        return view('dashboard.committee_members.show')->with([
            'committee_member' => $committee_member
        ]);
    }

    public function edit($slug){
        $committee_member = $this->committee_members->show($slug);
        return view('dashboard.committee_members.edit')->with([
            'committee_member' => $committee_member
        ]);
    }

    


    public function update(CommitteeMembersFormRequest $request, $slug){
        $committee_member = $this->committee_members->update($request, $slug);
        return $committee_member;


    }

    


    public function destroy($slug){
        $committee_member = $this->committee_members->destroy($slug);
        return $committee_member;
    }





}
