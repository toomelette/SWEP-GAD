<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class SeminarFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){
        
        return [

            'title'=>'required|string|max:255',
            'date_covered_from'=>'required|date_format:"m/d/Y"',
            'date_covered_to'=>'required|date_format:"m/d/Y"',
            
        ];

    }







}
