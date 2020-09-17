<?php

namespace App\Http\Requests\CommitteeMembers;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeMembersFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){
        
        $rules = [

            'slug_afd' => 'nullable|string|max:45', 
            'fname' => 'required|string|max:45', 
            'mname' => 'nullable|string|max:45', 
            'lname' => 'required|string|max:45', 
            'based_on' => 'required|string|max:45', 
            'sex' => 'required|string|max:10', 
            'is_active' => 'required|string|max:10',            
        ];

       
        return $rules;

    }







}
