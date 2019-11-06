<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class SeminarFilterRequest extends FormRequest{



    public function authorize(){

        return true;
    }

   


    public function rules(){

        return ['q' => 'nullable|string|max:90',];

    }




    
}