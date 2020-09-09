<?php

namespace App\Http\Controllers;


use App\Core\Services\MillDistrictService;
use App\Core\Services\BlockFarmService;
use App\Http\Requests\MillDistrict\MillDistrictFormRequest;
use Datatables;
use Yajra\DataTables\Html\Builder;




class MillDistrictController extends Controller{
 



    protected $mill_district;
    protected $block_farm;

    public function __construct(MillDistrictService $mill_district,BlockFarmService $block_farm){
        
        $this->mill_district = $mill_district;
        $this->block_farm = $block_farm;
    }

    public function create(){
        return 'Create';
    }

    public function index(Builder $builder){
        $html = $builder->parameters([
            'rowGroup'=> [
                'dataSrc' => ['location']
            ]
        ]);



        if(request()->ajax())
        {      
            $data = request();
            return datatables()->of($this->mill_district->fetchTable($data))
            ->addColumn('action', function($data){
                $button = '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm show_mill_district_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_mill_district_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_mill_district_btn" data-toggle="modal" data-target="#edit_mill_district_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_mill_district_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                return $button;
            })  
            ->escapeColumns([])
            ->setRowId('slug')
            ->make(true);
        }



        $regions = json_encode($this->regions());      

        return view('dashboard.mill_district.index', compact('html'))->with([
            'regions'=>$regions,
            'regions_array'=>$this->regions(),
        ]);
    }

    public function store(MillDistrictFormRequest $request){

       return $this->mill_district->store($request);

    }


    public function show($slug){
  
        $mill_district = $this->mill_district->show($slug);

        $block_farms = $mill_district->blockFarms;

        $members = [];
        $bf_members_by_civil = [];
        // $bf_members_by_civil['hahaha'] = "haruuu";
        foreach($block_farms as $block_farm){
            
            $m = [];
            foreach($block_farm->blockFarmMembers as $bf_members){
                $members[$bf_members->slug] = $bf_members;
                $bf_members_by_civil[$bf_members->civil_status][$bf_members->slug] = $bf_members->slug;
            }

            // $members[$block_farm->slug] = $m;
        }

        $participants = [];

        $seminars = $mill_district->seminars;

        foreach($seminars as $seminar){
            
            foreach($seminar->seminarParticipant as $seminar_participants){
                $participants[$seminar_participants->slug] = $seminar_participants;
            }

            // $members[$block_farm->slug] = $m;
        }

        return view('dashboard.mill_district.show')->with([
            'mill_district' => $mill_district,
            'bf_members' => $members,
            'seminar_participants' => $participants,
            'bf_members_by_civil' => $bf_members_by_civil
        ]) ;
    }

    public function edit($slug){
        $mill_district = $this->mill_district->edit($slug);

        $regions = $this->regions();
        $locations = [];
        $under_location = [];

        foreach ($regions as $key => $location) {
            $locations[$key]= $key;

            foreach ($regions[$mill_district->location] as $key2 => $under) {
                $under_location[$under] = $under;
            }
            
        }


        return view('dashboard.mill_district.edit')
        ->with([
            'mill_district'=>$mill_district,
            'locations' => $locations,
            'regions_under_location' => $under_location
        ]);
    }

    public function update(MillDistrictFormRequest $request, $slug){
        return $this->mill_district->update($request,$slug);
    }

    public function destroy($slug){
        return $this->mill_district->destroy($slug);
    }

    private function regions(){
        $regions =[
            'Luzon'=>[
                'NCR', 'CAR','I', 'II', 'III','IV', 'V'
            ],
            'Negros'=>[
                'VI', 'VII'
            ],
            'Panay'=>[
                'VI'
            ],
            'Eastern Visayas'=>[
                'VII', 'VIII'
            ],
            'Mindanao'=>[
                'IX', 'X', 'XI','XII', 'XIII', 'ARMM'
            ]
        ];
        return $regions;
    }
    
}
