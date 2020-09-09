<?php

namespace App\Http\Requests\SeminarParticipant;

use Illuminate\Foundation\Http\FormRequest;

class SeminarParticipantEditFormRequest extends FormRequest{



    
    public function authorize(){

        return true;
    
    }




    public function rules(){

        return [

        	'fullname' => 'required|string|max:255',
            'age' => 'required|int|max:130',
            'sex' => 'required|string|max:11',
            'civil_status' => 'nullable|string|max:45',
            'occupation' => 'nullable|string|max:45',
            'educ_att' => 'nullable|string|max:45',
            
        ];
    
    }




}
