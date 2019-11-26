<?php

namespace App\Http\Requests\SeminarParticipant;

use Illuminate\Foundation\Http\FormRequest;

class SeminarParticipantEditFormRequest extends FormRequest{



    
    public function authorize(){

        return true;
    
    }




    public function rules(){

        return [

        	'e_fullname' => 'required|string|max:255',
        	'e_address' => 'required|string|max:255',
        	'e_sex' => 'required|string|max:11',
        	'e_contact_no' => 'nullable|string|max:45',
        	'e_email' => 'nullable|string|max:90',
            
        ];
    
    }




}
