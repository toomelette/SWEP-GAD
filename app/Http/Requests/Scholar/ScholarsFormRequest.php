<?php

namespace App\Http\Requests\Scholar;

use Illuminate\Foundation\Http\FormRequest;

class ScholarsFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){
        
        $rules = [


            'scholarship_applied' => 'required|string|max:45', 
            'course_applied' => 'required|string|max:45', 
            'school' => 'required|string|max:60', 
            'mill_district' => 'required|string|max:45', 
            'lastname' => 'required|string|max:45', 
            'firstname' => 'required|string|max:45', 
            'middlename' => 'required|string|max:45', 
            'birth' => 'required|date_format:"m/d/Y"', 
            'sex' => 'required|string|max:6', 
            'civil_status' => 'required|string|max:15', 
            'address_province' => 'required|string|max:60', 
            'address_city' => 'required|string|max:60', 
            'address_specific' => 'required|string|max:100', 
            'address_no_years' => 'required|int|max:130', 
            'phone' => 'required|string|max:20', 
            'citizenship' => 'required|string|max:20', 
            'occupation' => 'nullable|string|max:45', 
            'office_name' => 'nullable|string|max:45', 
            'office_address' => 'nullable|string|max:60', 
            'office_phone' => 'nullable|string|max:20', 
            'mother_name' => 'nullable|string|max:45', 
            'mother_phone' => 'nullable|string|max:20', 
            'father_name' => 'nullable|string|max:45', 
            'father_phone' => 'nullable|string|max:20', 
            'spouse_name' =>'nullable|string|max:45' , 
            'spouse_phone' => 'nullable|string|max:20', 
            'spouse_address' => 'nullable|string|max:100',             
        ];

       
        return $rules;

    }







}
