<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\ScholarsInterface;

use App\Models\Scholars;


class ScholarsRepository extends BaseRepository implements ScholarsInterface {
	


    protected $scholars;



	public function __construct(Scholars $scholars){

        $this->scholars = $scholars;
        parent::__construct();

    }





    public function fetch($request){

       
    }


    public function fetchTable(){

        return $this->scholars->latest()->get(['slug','lastname', 'firstname', 'middlename', 'scholarship_applied', 'course_applied','school', 'mill_district', 'birth', 'sex', 'address_province','address_city']);
    
    }



    public function store($request){
        $scholars = New Scholars;
        $scholars->slug = $this->str->random(32);
        $scholars->scholarship_applied = $request->scholarship_applied;
        $scholars->course_applied = $request->course_applied;
        $scholars->school = $request->school;
        $scholars->mill_district = $request->mill_district;
        $scholars->lastname = $request->lastname;
        $scholars->firstname = $request->firstname;
        $scholars->middlename = $request->middlename;
        $scholars->birth = date("Y-m-d",strtotime($request->birth));
        $scholars->sex = $request->sex;
        $scholars->civil_status = $request->civil_status;
        $scholars->address_province = $request->address_province;
        $scholars->address_city = $request->address_city;
        $scholars->address_specific = $request->address_specific;
        $scholars->address_no_years = $request->address_no_years;
        $scholars->phone = $request->phone;
        $scholars->citizenship = $request->citizenship;
        $scholars->occupation = $request->occupation;
        $scholars->office_name = $request->office_name;
        $scholars->office_address = $request->office_address;
        $scholars->office_phone = $request->office_phone;
        $scholars->mother_name = $request->mother_name;
        $scholars->mother_phone = $request->mother_phone;
        $scholars->father_name = $request->father_name;
        $scholars->father_phone = $request->father_phone;
        $scholars->spouse_name = $request->spouse_name;
        $scholars->spouse_phone = $request->spouse_phone;
        $scholars->spouse_address = $request->spouse_address;
        $scholars->created_at = $this->carbon->now();
        $scholars->updated_at = $this->carbon->now();
        $scholars->ip_created = request()->ip();
        $scholars->ip_updated = request()->ip();
        $scholars->user_created = $this->auth->user()->user_id;
        $scholars->user_updated = $this->auth->user()->user_id;
        $scholars->save();
        return $scholars;
    }





    public function update($request, $slug){

        $scholars = $this->findBySlug($slug);
        $scholars->scholarship_applied = $request->scholarship_applied;
        $scholars->course_applied = $request->course_applied;
        $scholars->school = $request->school;
        $scholars->mill_district = $request->mill_district;
        $scholars->lastname = $request->lastname;
        $scholars->firstname = $request->firstname;
        $scholars->middlename = $request->middlename;
        $scholars->birth = date("Y-m-d",strtotime($request->birth));
        $scholars->sex = $request->sex;
        $scholars->civil_status = $request->civil_status;
        $scholars->address_province = $request->address_province;
        $scholars->address_city = $request->address_city;
        $scholars->address_specific = $request->address_specific;
        $scholars->address_no_years = $request->address_no_years;
        $scholars->phone = $request->phone;
        $scholars->citizenship = $request->citizenship;
        $scholars->occupation = $request->occupation;
        $scholars->office_name = $request->office_name;
        $scholars->office_address = $request->office_address;
        $scholars->office_phone = $request->office_phone;
        $scholars->mother_name = $request->mother_name;
        $scholars->mother_phone = $request->mother_phone;
        $scholars->father_name = $request->father_name;
        $scholars->father_phone = $request->father_phone;
        $scholars->spouse_name = $request->spouse_name;
        $scholars->spouse_phone = $request->spouse_phone;
        $scholars->spouse_address = $request->spouse_address;
        $scholars->updated_at = $this->carbon->now();
        $scholars->ip_updated = request()->ip();
        $scholars->user_updated = $this->auth->user()->user_id;
        $scholars->save();

        return $scholars;

    }





    public function destroy($slug){

        $scholars = $this->findBySlug($slug);
        $scholars->delete();

        return $scholars;

    }





    public function findBySlug($slug){

        return $this->scholars->where('slug',$slug)->first();

    }






    public function findByMenuId($menu_id){



    }






    public function getAll(){


    }






    private function getMenuIdInc(){


        
    }






    private function search($instance, $key){



    }





    private function populate($instance, $entries){


    }






}