<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Core\Services\BlockFarmService;
use App\Core\Services\BlockFarmProblemService;
use App\Core\Services\BFEncounteredProblemService;
use App\Http\Requests\BlockFarm\BlockFarmFormRequest;
use App\Core\Services\MillDistrictService;
use Datatables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Http\Request;




class BlockFarmController extends Controller{
 



    protected $block_farm;
    protected $block_farm_problem;
    protected $mill_district;

    public function __construct(BlockFarmService $block_farm, BlockFarmProblemService $block_farm_problem, BFEncounteredProblemService $bf_encountered_problem,MillDistrictService $mill_district){

    	$this->block_farm = $block_farm;
    	$this->block_farm_problem = $block_farm_problem;
        $this->bf_encountered_problem = $bf_encountered_problem;
        $this->mill_district = $mill_district;
    }

    public function create(){
    	return 'Create';
    }

    public function index(Builder $builder){
        $html = $builder->parameters([
            'rowGroup'=> [
                'dataSrc' => ['mill_district']
            ]
        ]);

        if(request()->ajax())
        {   
            $data = request();
            return datatables()->of($this->block_farm->fetchTable($data))
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

        $search = '';
        if(!empty(request()->get('search'))){
            $search = request()->get('search');
        }

    	return view("dashboard.block_farm.index",compact('html'))->with([
            'mill_districts' => $this->mill_district->mills_grp(),
            'mill_districts_list' => $this->mill_district->mills(),
            'search' => $search,
            'data' => $data
        ]);

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
        return $this->block_farm->edit($slug)->with([
            'mill_districts' => $this->mill_district->mills_grp(),
            'mill_districts_list' => $this->mill_district->mills()
        ]);
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

    public function reports(){
        return view('dashboard.block_farm.reports')->with([
            'mill_districts_list' => $this->mill_district->mills(),
            'columns' => $this->columns()
        ]);
    }
    
    public function report_generate(Request $request){
       
       $filters = [];
        
        foreach ($request->all() as $key => $value) {
            if(!is_array($value)){
                if($key != "layout" and $value != null){
                    if($key == "mill_district"){
                        $mill_d = $this->findMillDistrict($value);
                        array_push($filters, $mill_d->mill_district);
                    }else{
                        array_push($filters, $value);
                    }
                }
            }          
        }


        $block_farms = $this->block_farm->getRaw();
        
        if(!empty($request->date_range)){
            $date_range = "";
            $date_range = explode('-', $request->date_range);
            foreach ($date_range as $key => $value) {
                $date_range[$key] = date("Ymd",strtotime($value));
            }
            $df = $date_range[0];
            $dt = $date_range[1];

            $block_farms = $block_farms->whereBetween('date',[$df,$dt]);

        }

        if(!empty($request->mill_district)){
            $block_farms = $block_farms->where('mill_district','=',$request->mill_district);
        }
        if($request->layout == "all"){
            return view('printables.block_farm.list_all')->with([
                'block_farms' => $block_farms->get(),
                'columns_chosen' => $request->get('columns'),
                'columns' => $this->columns(),
                'filters'=> $filters
            ]);
        }

        if($request->layout == "mill_district"){
            $block_farms = $block_farms->get();
            $block_farms_group = [];

            foreach($block_farms as $block_farm){
               $block_farms_group[$block_farm->millDistrict->mill_district][$block_farm->slug] = $block_farm;
             
            }

            //return $block_farms_group;
            return view('printables.block_farm.grouped_list')->with([
                'block_farms_group' => $block_farms_group,
                'columns_chosen' => $request->get('columns'),
                'columns' => $this->columns(),
                'filters'=> $filters
            ]);
        }
       
    }

    private function columns(){
        $columns = [
            "Numbering" => "numbering",
            "Date" => "date",
            "Enrolee" => "enrolee_name",
            "Mill District" => "mill_district",
            "Male Members" => "male_members",
            "Female Members" => "female_members",
            "Members" => "members"
        ];
        return $columns;
    }

     public function findMillDistrict($slug){
        $mill_district = $this->mill_district->find($slug);
        return $mill_district;
    }
}
