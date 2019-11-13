<?php

namespace App\Http\Requests\Seminar;

use Illuminate\Foundation\Http\FormRequest;

class SeminarFormRequest extends FormRequest{


    public function authorize(){

        return true;
    
    }



    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'title' => 'required|string|max:255',
            'sponsor' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'date_covered_from' => 'required|date_format:"m/d/Y"',
            'date_covered_to' => 'required|date_format:"m/d/Y"',

        ];
    
    }


}
