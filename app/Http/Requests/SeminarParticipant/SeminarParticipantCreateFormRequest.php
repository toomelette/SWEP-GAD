<?php

namespace App\Http\Requests\SeminarParticipant;

use Illuminate\Foundation\Http\FormRequest;

class SeminarParticipantCreateFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }




    public function rules(){

        return [

        	'fullname' => 'required|string|max:255',
        	'address' => 'required|string|max:255',
        	'sex' => 'required|string|max:11',
        	'contact_no' => 'nullable|string|max:45',
        	'email' => 'nullable|string|max:90',
        ];
    
    }




}
