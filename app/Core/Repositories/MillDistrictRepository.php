<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\MillDistrictInterface;
use App\Models\MillDistrict;

class MillDistrictRepository extends BaseRepository implements MillDistrictInterface {
	


    protected $mill_district;



	public function __construct(MillDistrict $mill_district){
        $this->mill_district = $mill_district;
        parent::__construct();
    }





    public function fetch($slug){


    }

    public function fetchTable($data){
        $get = $this->mill_district;

        if(!empty($data->location)){
            $get = $get->where('location','=',$data->location);
        }

        if(!empty($data->region)){
            $get = $get->where('region','=',$data->region);
        }

        $get = $get->latest()->get();
        return $get;

    }

    public function store($request){

        $mill_district = new MillDistrict;
        $mill_district->slug = $this->str->random(16);
        $mill_district->location = $request->location;
        $mill_district->region = $request->region;
        $mill_district->mill_district= strtoupper($request->mill_district);
        $mill_district->chairman= $request->chairman;
        $mill_district->address = $request->address;
        $mill_district->mdo = $request->mdo;
        $mill_district->phone = $request->phone;
        $mill_district->created_at = $this->carbon->now();
        $mill_district->updated_at = $this->carbon->now();
        $mill_district->ip_created = $this->carbon->now();
        $mill_district->ip_updated = $this->carbon->now();
        $mill_district->user_created = $this->auth->user()->user_id;

        $mill_district->save();
        return $mill_district;
    }





    public function update($request, $slug){
        $mill_district = $this->findBySlug($slug);
        $mill_district->location = $request->location;
        $mill_district->region = $request->region;
        $mill_district->mill_district= strtoupper($request->mill_district);
        $mill_district->chairman= $request->chairman;
        $mill_district->address = $request->address;
        $mill_district->mdo = $request->mdo;
        $mill_district->phone = $request->phone;
        
        $mill_district->updated_at = $this->carbon->now();
        
        $mill_district->ip_updated = $this->carbon->now();
        $mill_district->user_updated = $this->auth->user()->user_id;

        $mill_district->save();

        return $mill_district;
    }





    public function destroy($slug){
        $mill_district = $this->findBySlug($slug);
        $mill_district->delete();
        return $mill_district;
    }


    public function findByName($name)
    {
        return $this->mill_district->where('mill_district','=',$name)->get()->first();
    }


    public function findBySlug($slug){

        return $this->mill_district->where('slug','=',$slug)->first();

    }


    public function fetchAll(){
        return $this->mill_district->get();
    }



    public function findByMenuId($menu_id){



    }

    public function raw(){
        return $this->mill_district;
    }

}