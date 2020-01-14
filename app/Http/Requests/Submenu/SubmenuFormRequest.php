<?php

namespace App\Http\Requests\Submenu;

use Illuminate\Foundation\Http\FormRequest;

class SubmenuFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){
        
        $rules = [

            'name'=>'required|string|max:45',
            'nav_name'=>'nullable|string|max:45',
            'route'=>'required|string|max:45',
            'is_nav'=>'required|string|max:5'

            
        ];



        return $rules;

    }







}
