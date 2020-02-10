<?php

namespace App\Http\Controllers;


use App\Core\Services\ScholarsService;
use App\Core\Services\MillDistrictService;
use App\Http\Requests\Scholar\ScholarsFormRequest;




class ScholarsController extends Controller{


    protected $scholars;

    protected $mill_district;

    public function __construct(ScholarsService $scholars,MillDistrictService $mill_district){

        $this->scholars = $scholars;
        $this->mill_district = $mill_district;
    }


    
    public function index(){

        if(request()->ajax())
        {   
            $data = request();
            
            return datatables()->of($this->scholars->fetchTable($data))
            ->addColumn('action', function($data){
                $button = '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm show_scholars_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_scholars_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_scholars_btn" data-toggle="modal" data-target="#edit_scholars_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_scholars_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                return $button;
            })->editColumn('fullname',function($data){

                return '<div>'.$data->lastname.", " .$data->firstname.'
                            <div class="table-subdetail">
                                '.$data->address_city.', '.$data->address_province.'
                            </div>
                        </div>';


            })->editColumn('scholarship_applied',function($data){

                switch ($data->scholarship_applied) {
                    case 'TESDA':
                        return "TESDA";
                        break;
                    case 'CHED':
                        return "CHED";
                        break;
                    case 'SRA':
                        return "SRA";
                        break;
                    default:
                        # code...
                        break;
                }
 
            })->editColumn('course_school',function($data){

                return '<div>'.$data->course_applied.'
                            <div class="table-subdetail">
                                '.$data->school.'
                            </div>
                        </div>';
 
            })->editColumn('sex',function($data){
                if($data->sex == "MALE"){
                    return '<span class="label bg-green col-md-12"><i class="fa fa-male"></i> '.$data->sex.'</span>';
                }elseif($data->sex == "FEMALE"){
                    return '<span class="label bg-maroon col-md-12"><i class="fa fa-female"></i> '.$data->sex.'</span>';
                }else{
                    return $data->sex;
                }
                
            })
            ->editColumn('birth', function($data){
                return date("M. d, Y",strtotime($data->birth));
            })
            ->editColumn('mill_district', function($data){

                if($data->millDistrict['mill_district'] == ''){
                    return $data->mill_district;
                }
                return $data->millDistrict['mill_district'];
            })
            ->escapeColumns([])
            ->setRowId('slug')
            ->make(true);
        }


    //return $this->scholars->insert();

    $mill_districts = $this->mill_district->fetchAll();
    $mills = [];

    $courses = $this->scholars->getAllCourses();
    foreach ($mill_districts as $key => $mill_district) {
        if(isset($mills[$mill_district->location][$mill_district->mill_district])){
            $mills[$mill_district->location][$mill_district->mill_district] = [$mill_district->mill_district];
        }else{
            $mills[$mill_district->location][$mill_district->mill_district] = $mill_district->slug;
        }
    }

    return view('dashboard.scholars.index')->with([
        'mill_districts' => $mills,
        'courses' => $courses
    ]);
    }

    

    public function create(){
        
        

    }

   

    public function store(ScholarsFormRequest $request){
        
        $scholars = $this->scholars->store($request);

        return $scholars;

    }
 



    public function show($slug){
        
        return $this->scholars->show($slug);

    }

    public function edit($slug){
        return $this->scholars->edit($slug);
    }




    public function update(ScholarsFormRequest $request, $slug){
        
        return $this->scholars->update($request, $slug);;
        

    }

    


    public function destroy($slug){

        return $this->scholars->destroy($slug);
    }



    
}
