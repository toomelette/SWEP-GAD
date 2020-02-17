<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\ScholarsInterface;
use App\Core\Interfaces\TempInterface;
use App\Core\Interfaces\MillDistrictInterface;
use App\Core\BaseClasses\BaseService;


class ScholarsService extends BaseService{


    protected $scholars_repo;
    protected $temp_repo;
    protected $mill_district_repo;



    public function __construct(ScholarsInterface $scholars_repo, TempInterface $temp_repo, MillDistrictInterface $mill_district_repo){

        $this->scholars_repo = $scholars_repo;
        $this->temp_repo = $temp_repo;
        $this->mill_district_repo = $mill_district_repo;
        parent::__construct();

    }

    public function insert()
    {
        $data = $this->temp_repo->fetch();
        foreach ($data as $temps) {
            
            $mill_district = $this->mill_district_repo->findByName(strtoupper($temps->Mill_District));
            $mill_slug = $mill_district['slug'];
            $slug = $this->str->random(16);
            $request = collect();
            $request->slug = $slug;

            if($mill_slug == ''){
                $mill_slug = $temps->Mill_District;
            }
            $request->mill_district = $mill_slug;
            $request->scholarship_applied = 'CHED';
            $request->course_applied = $temps->Course;
            $request->resolution_no = $temps->Resolution_No;
            $request->school = $temps->HEI;
            $request->lastname = $temps->Last_Name;
            $request->firstname = $temps->First_Name;
            $request->firstname = $temps->First_Name;
            $request->middlename = str_replace('.', '', $temps->M_I);
            $request->birth = '';

            if($temps->Gender == 'M'){
                $sex = 'MALE';
            }else{
                $sex = 'FEMALE';
            }

            $request->sex = $sex;
            $request->civil_status = '';
            $request->address_province = $temps->Province;
            $request->address_city = $temps->Town_City;
            $request->address_specific = $temps->Brgy_Street;
            $request->address_no_years = 0;
            $request->phone = $temps->Contact;
            $request->citizenship = '';
            $request->occupation = '';
            $request->office_name = '';
            $request->office_address = '';
            $request->office_phone = '';
            $request->mother_name = '';
            $request->mother_phone = '';
            $request->father_name = '';
            $request->father_phone = '';
            $request->spouse_name = '';
            $request->spouse_phone = '';
            $request->spouse_address = '';

            $this->scholars_repo->store($request);

            $this->temp_repo->update($request, $temps->Total_No);
        }
        return 'Done';
    }



    public function fetch($request){

    

    }

    public function fetchTable($data){

        return $this->scholars_repo->fetchTable($data);

    }




    public function store($request){
        $scholars = $this->scholars_repo->store($request);
        return $scholars;

    }


    public function getAllCourses(){
        return $scholars = $this->scholars_repo->getAllCourses();
    }



    public function show($slug){

        $scholars = $this->scholars_repo->findBySlug($slug);


        $age = 0;
        $birth = date("Y-m-d",strtotime($scholars->birth));

        while ($birth <= date( "Y-m-d",strtotime( now() ) ) ) {
            
            $birth = date("Y-m-d",strtotime($birth."+ 1 year"));
            $age++;
        }

        $scholars->age = $age-1;
        return view('dashboard.scholars.show')->with([ 'scholars' => $scholars]);
    }


    public function edit($slug){

        return $scholars = $this->scholars_repo->findBySlug($slug);
         

    }



    public function update($request, $slug){

        return $this->scholars_repo->update($request,$slug);

    }








    public function destroy($slug){

        $scholars = $this->scholars_repo->destroy($slug);
        return $scholars;
    }






}