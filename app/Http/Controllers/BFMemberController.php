<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Services\BlockFarmService;
use App\Core\Services\BFMemberService;
use App\Http\Requests\BlockFarm\BFMemberFormRequest;
// use App\Core\Services\BlockFarmProblemService;
// use App\Core\Services\BFEncounteredProblemService;
// use App\Http\Requests\BlockFarm\BlockFarmFormRequest;
// use App\Core\Services\MillDistrictService;
use Datatables;





class BFMemberController extends Controller{
 
    protected $block_farm;
    protected $bf_member;


    public function __construct(BlockFarmService $block_farm, BFMemberService $bf_member){
        $this->block_farm = $block_farm;
        $this->bf_member = $bf_member;
    }

    public function create(){
    	return 'Create';
    }

    

    public function index(Request $request){
        if($request->ajax()){
            
            if(!empty($request->draw)){
                $data = $request;
                return datatables()->of($this->bf_member->fetchTable($data))
                ->editColumn('fullname', function($data){
                    return $data->lastname.", ".$data->firstname. " ".substr($data->middlename, 0, 1).".";
                })
                ->editColumn('block_farm_details', function($data){
                    $return = "<div>". $data->block_farm_name;
                    $return = $return.
                            '<div class="table-subdetail">
                                '.$data->mill_district.' 
                            </div>';
                    $return = $return."</div>";
                    return $return;
                })
                ->editColumn('bday', function($data){
                    // $bday = new DateTime('11.4.1987'); // Your date of birth
                    // $today = new Datetime(date('m.d.y'));
                    // $diff = $today->diff($bday);

                    // $years = \Carbon::parse($data->bday)->age;

                    // $return = "<div>". $data->bday;
                    // $return = $return.
                    //         '<div class="table-subdetail">
                    //             '.$years.' year(s) old
                    //         </div>';
                    // $return = $return."</div>";
                    return date("M. d, Y",strtotime($data->bday));
                })
                ->editColumn('age', function($data){
                    $years = \Carbon::parse($data->bday)->age;
                    return $years;
                })
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm show_bf_member_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_bf_member_modal" title="View more" data-placement="left">
                                        <i class="fa fa-file-text"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_bf_member_btn" data-toggle="modal" data-target="#edit_bf_member_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_bf_member_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>';
                    return $button;
                })->editColumn('sex',function($data){
                    if($data->sex == "MALE"){
                        return '<span class="label bg-green col-md-12"><i class="fa fa-male"></i> '.$data->sex.'</span>';
                    }elseif($data->sex == "FEMALE"){
                        return '<span class="label bg-maroon col-md-12"><i class="fa fa-female"></i> '.$data->sex.'</span>';
                    }else{
                        return $data->sex;
                    }
                    
                })
                ->editColumn('bday', function($data){
                    return date("F d, Y",strtotime($data->bday));
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
            }

            $query = $request['query'];
            $block_farm_list = $this->block_farm->list($query);

            if(!empty($request->get_block_farm_id)){
                $bf_id = request()->get_block_farm_id;
                $block_farm = $this->block_farm->get($bf_id);
                return view('dashboard.bf_member.block_farm_details')->with(['block_farm' => $block_farm]);
            }

            if(!empty($request->query)){
                $result = $block_farm_list;
                return $result;
            }
        }

        $search = '';
        if(!empty($request->search)){
            $search = $request->search;
        }

        return view("dashboard.bf_member.index")->with(['search' => $search]);
    }

    public function store(BFMemberFormRequest $request){
        return $this->bf_member->store($request);
    }

    public function show($slug){
        // return $this->block_farm->show($slug);
        $bf_member = $this->bf_member->show($slug);
        $bf_member->age = \Carbon::parse($bf_member->bday)->age;
        return view('dashboard.bf_member.show')->with([
            'bf_member' => $bf_member
        ]);
    }

    public function edit($slug){
         $bf_member = $this->bf_member->edit($slug);
         return view('dashboard.bf_member.edit')->with([
            'bf_member' => $bf_member
         ]);
        // return $this->block_farm->edit($slug);
    }

    public function update(BFMemberFormRequest $request, $slug){
        $bf_member = $this->bf_member->update($request, $slug);
        return $bf_member;
    }

    public function destroy($slug){
        return $this->bf_member->destroy($slug);
        //return $slug;
    }

    
    
}
