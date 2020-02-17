<?php

namespace App\Http\Requests\BlockFarm;

use Illuminate\Foundation\Http\FormRequest;

class BFMemberFormRequest extends FormRequest{


    public function authorize(){

        return true;
    
    }



    public function rules(){
        $f = 'form_data.';
        $rules =  [
            
            // 'doc_file' => 'nullable|mimes:pdf|max:50000',
            //'date' => 'required|date_format:"m/d/Y"',
            'lastname' => 'required|string|max:45',
            'firstname' => 'required|string|max:45',
            'middlename' => 'required|string|max:45',
            'bday' => 'required|date_format:"m/d/Y"',
            'sex' => 'required|string|max:6',
            'civil_status' => 'required|string|max:20',
            'educ_att' => 'required|string|max:32',
            'years_sugarcane_farming' => 'required|int|max:130',
            'tenurial' => 'required|string|max:45',
            'chosen_bf' => 'required|string|max:45',
            // 'female_family' => 'required|int|max:50',
            // 'plant_total_area' => 'nullable|numeric|max:100000',
            // 'plant_lkg_tc' => 'nullable|numeric|max:100000',
            // 'plant_tc_ha' => 'nullable|numeric|max:100000',
            // 'plant_lkg_ha' => 'nullable|numeric|max:100000',
            // 'ratoon_total_area' => 'nullable|numeric|max:100000',
            // 'ratoon_lkg_tc' => 'nullable|numeric|max:100000',
            // 'ratoon_tc_ha' => 'nullable|numeric|max:100000',
            // 'ratoon_lkg_ha' => 'nullable|numeric|max:100000',
            // 'specify_problem' => 'nullable|string|max:500',
        ];


        // if(!empty($this->request->get('row'))){
        //     foreach($this->request->get('row') as $key => $value){
        //         $rules['row.'.$key.'.spkr_fullname'] = 'required|string|max:255';
        //         $rules['row.'.$key.'.spkr_topic'] = 'nullable|string|max:255';
        //     } 
        // }

        return $rules;
    
    }
    // protected function prepareForValidation(){
    //     $this->merge([
    //         'lastname' => $request
    //     ]);
    // }

    // protected function prepareForValidation()
    // {

    //     function rawCurrency($value){
    //         $value = str_replace(',', '', $value);
    //         $value = str_replace('₱', '', $value);
    //         return $value;
    //     }

    //     $this->merge([
    //         'annual_income' => rawCurrency($this->annual_income),
    //         'annual_expense' => rawCurrency($this->annual_expense),
    //     ]);        
    // }

    



}
