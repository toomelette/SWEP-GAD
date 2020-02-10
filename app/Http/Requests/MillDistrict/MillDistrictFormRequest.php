<?php

namespace App\Http\Requests\MillDistrict;

use Illuminate\Foundation\Http\FormRequest;

class MillDistrictFormRequest extends FormRequest{


    public function authorize(){

        return true;
    
    }



    public function rules(){

        $rules =  [
            
            // 'doc_file' => 'nullable|mimes:pdf|max:50000',
            'location' => 'required|string|max:15',
            'region' => 'required|string|max:5',
            'mill_district' => 'required|string|max:255',
            'chairman' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mdo' => 'required|string|max:255',
            'phone' => 'required|string|max:255'

        ];


        return $rules;
    
    }

    



}
