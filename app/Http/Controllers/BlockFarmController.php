<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Core\Services\BlockFarmService;
use App\Core\Services\BlockFarmProblemService;
use App\Core\Services\BFEncounteredProblemService;
use App\Http\Requests\BlockFarm\BlockFarmFormRequest;
use Datatables;





class BlockFarmController extends Controller{
 



    protected $block_farm;
    protected $block_farm_problem;

    public function __construct(BlockFarmService $block_farm, BlockFarmProblemService $block_farm_problem, BFEncounteredProblemService $bf_encountered_problem){
    	$this->block_farm = $block_farm;
    	$this->block_farm_problem = $block_farm_problem;
        $this->bf_encountered_problem = $bf_encountered_problem;
    }

    public function create(){
    	return 'Create';
    }

    public function index(){


        if(request()->ajax())
        {   
            return datatables()->of($this->block_farm->fetchTable())
            ->addColumn('action', function($data){
                $button = '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm show_block_farm_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_block_farm_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_block_farm_btn" data-toggle="modal" data-target="#edit_block_farm_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_block_farm_btn" data-toggle="tooltip" title="Delete" data-placement="top">
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
            ->editColumn('date', function($data){
                return date("F d, Y",strtotime($data->date));
            })
            ->escapeColumns([])
            ->setRowId('slug')
            ->make(true);
        }


    	
    	$problems_array = [];
    	$data = $this->block_farm_problem->fetch();
    	foreach ($data as $key => $value) {
    		if(isset($problems_array[$value->slug])){
    			$problems_array[$value->type][$value->slug] =  [
    				'id' => $value->id,
    				'slug' => $value->slug,
    				'problem' => $value->problem,
    				'type'=> $value->type
    			];
    		}else{
    			$problems_array[$value->type][$value->slug] = [
    				'id' => $value->id,
    				'slug' => $value->slug,
    				'problem' => $value->problem,
    				'type'=> $value->type
    			];
    		}
    	}

    	$data = $problems_array;

    	return view("dashboard.block_farm.index",compact('data'));

    }

    public function store(BlockFarmFormRequest $request){
        //$validated  = $request->validated();
    	$block_farm = $this->block_farm->store($request);
        if($block_farm){
            return json_encode(array('result'=>1,'slug' => $block_farm->slug));
        }
    }

    public function show($slug){
        return $this->block_farm->show($slug);
    }

    public function edit($slug){
        return $this->block_farm->edit($slug);
    }

    public function update(BlockFarmFormRequest $request, $slug){
        // return "update";
        $block_farm = $this->block_farm->update($request, $slug);
        if ($block_farm) {
            return json_encode(array('result'=>1,'slug' => $slug)) ;
        }
    }

    public function destroy($slug){
        $block_farm = $this->block_farm->destroy($slug);
        return $block_farm;
    }
}
