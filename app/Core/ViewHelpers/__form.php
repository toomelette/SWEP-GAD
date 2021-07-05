<?php

namespace App\Core\ViewHelpers;

use App\Core\Helpers\__sanitize;
use App\Core\Helpers\__dataType;
use Carbon\Carbon;


class __form{



    /** Default **/
    public static function textbox($class, $key, $type, $label, $placeholder, $old_value, $id, $error_first, $extra_attr , $input_class = null){

        if($id == ""){
          $id = "";
        }else{
          $id= 'id = "'.$id.'"';
        }
       return '<div class="form-group col-md-'. $class .'">
                <label for="'. $key .'">'. $label .'</label>
                <input class="form-control '.$input_class.'" '. $id .' name="'. $key .'" type="'. $type .'" value="'. self::string_value($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
              </div>';

    }

    public static function textbox_icon($class, $key, $type, $label, $placeholder, $old_value, $id, $error_first, $extra_attr){

        if($id == ""){
          $id = "";
        }else{
          $id= 'id = "'.$id.'"';
        }

       return '<div class="form-group col-md-'. $class .'">
              <label for="'. $key .'">'. $label .'</label>
              <div class="input-group">  
                <input class="form-control with-icon" '. $id .' name="'. $key .'" type="'. $type .'" value="'. self::string_value($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
                <span class="input-group-addon"></span>
              </div></div>';

    }





    public static function textbox_password_btn($class, $name, $label, $placeholder, $old_value, $id, $error_first, $extra_attr){
        if($name == ""){
          $name = "";
        }else{
          $name = 'name="'.$name.'" ';
        }
       return '<div class="col-md-'.$class.' form-group">
                <label for="">'.$label.'</label>
                <div class="input-group">
                  <input type="password" '.$name.' placeholder="'.$placeholder.'" class="form-control" '.$extra_attr.'>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default show_pass" data-toggle="tooltip" title="Show/Hide Password" tabindex="-1">
                      <i class="fa fa-eye-slash"></i>
                    </button>
                  </span>
                </div>
              </div>';

    }



    public static function textbox_numeric($class, $key, $type, $label, $placeholder, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <input class="form-control priceformat" id="'. $key .'" name="'. $key .'" type="'. $type .'" value="'. __sanitize::html_attribute_encode($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
                  '. self::error_message($error_has, $error_first) .'
              </div>';

    }



    public static function select_dynamic($class, $key, $label, $old_value, $array, $var1, $var2, $error_has, $error_first, $select2, $extra_attr){
      
       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control '. $select2 .'" '. $extra_attr .' style="font-size:15px;">
                  <option value="">Select</option>
                  '. self::dynamic_options($array, $var1, $var2, $old_value) .'
                </select>
                '. self::error_message($error_has, $error_first) .'
              </div>';
    }

    public static function select_static($class, $key, $label, $old_value, $array, $error_has, $error_first, $select2, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" class="form-control '. $select2 .'" '. $extra_attr .' style="font-size:15px;">
                  <option value="">Select</option>
                  '. self::static_options($array, $old_value) .'
                </select>
                '. self::error_message($error_has, $error_first) .'
              </div>';
    }



    public static function select_object($class, $name, $label, $id, $object, $value ,$var_text, $var_value,$extra_attr, $input_class = null){

        $select = '<div class="form-group col-md-'. $class .'">
                <label for="'. $name .'">'. $label .'</label>
                <select name="'. $name .'" id="'. $id .'" class="form-control '. $input_class .'" '. $extra_attr .'">';
        foreach($object as $item){
            $selected = '';
            if($item->$var_value == $value){
                $selected = 'selected';
            }
            $select = $select.'<option value="'.$item->$var_value.'" '.$selected.'>'.$item->$var_text.'</option>';
        }
        $select = $select.'</select>
              </div>';
        return $select;
    }

    public static function select_object_project_code($class, $name, $label, $id, $object, $value , $extra_attr){

        $select = '<div class="form-group col-md-'. $class .'">
                <label for="'. $name .'">'. $label .'</label>
                <select name="'. $name .'" id="'. $id .'" class="form-control select2" '. $extra_attr .'">';
        if($value  == ''){
            $select = $select.'<option selected disabled>Select an option</option>';
        }
        foreach($object as $item){
            $selected = '';
            if($item->project_code == $value){
                $selected = 'selected';
            }
            $select = $select.'<option value="'.$item->project_code.'" >'.$item->project_code.' | '.substr($item->activity,0,25).'</option>';
        }
        $select = $select.'</select>
              </div>';
        return $select;
    }


    public static function select_static_group($class, $key, $label, $old_value, $array, $id, $error_first, $select2, $extra_attr){
      
      if($id == ""){
        
      }else{
        $id = "id='".$id."'";
      }
      $select = '<div class="form-group col-md-'. $class .' 
                  <label for="'. $key .'">'. $label .'</label>
                  <select name="'. $key .'" '. $id .' class="form-control '. $select2 .'" '. $extra_attr .' style="font-size:15px;">
                  <option value="">Select</option>';
      foreach ($array as $key => $value) {
        if(is_array($value)){
          $select = $select.'<optgroup label="'.$key.'">';
            foreach ($value as $key2 => $value2) {
              $select = $select. self::optionAddSelected($key2, $value2, $old_value);
            }
          $select = $select.'</optgroup>';
        }else{
          $select = $select. self::optionAddSelected($key, $value, $old_value);
        }
      }
      
      $select = $select.'</select>
                </div>';
       return $select;
    }

    public static function optionAddSelected($optval, $text, $old_value){
      if($optval == $old_value){
        return '<option value="'.$optval.'" selected>'.$text.'</option>';
      }else{
        return '<option value="'.$optval.'">'.$text.'</option>';
      }
    }

    public static function checkbox($class, $name, $label, $all_options, $checked_options, $extra_attr){
      $options_html = '';

      foreach ($all_options as $key => $value) {
        $checked = '';
        if(isset($checked_options[$key])){
          $checked = 'checked = ""';
        }

        $options_html = $options_html.'
        <div class="col-md-'.$class.'">
          <div class="checkbox no-margin">
            <label><input class="options" type="checkbox" '.$checked.' value="'.$key.'" name="'.$name.'" '.$extra_attr.' >'.$value.'</label>
          </div>
        </div>
        ';
      }

      return $options_html;
    }

    public static function radio_sex($class, $name, $label, $all_options, $selected, $extra_attr){
      $options = "";
      $all_options = ["MALE"=> "Male", "FEMALE"=> "Female"];
      foreach ($all_options as $key => $value) {
        $checked = '';
        if(strtoupper($selected) == $key){
          $checked = "checked";
        }
        $options = $options.'<label  style="margin-left: 15px">
        <input type="radio" name="'.$name.'" value="'.$key.'" '.$checked.' >'.$value.'
        </label>';
      }

      return '<div class="form-group col-md-'.$class.'">
                <label for="sex">'.$label.'</label>
                <div class="radio">
                  '.$options.'
                </div>                    
              </div>';
    }




    public static function textarea($class, $key, $label, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <textarea id="editor" name="'. $key .'" cols="80" '. $extra_attr .'>'. __sanitize::html_encode($old_value) .'</textarea>
                '. self::error_message($error_has, $error_first) .'
              </div>';

    }

    public static function native_textarea($length,$name,$label,$value,$row,$extra_attr){
        return '<div class="form-group col-md-'.$length.'">
                    <label>'.$label.'</label>
                    <textarea class="form-control" name="'.$name.'" rows="'.$row.'" placeholder="" '.$extra_attr.'>'.$value.'</textarea>
                </div>';
    }



    public static function datepicker($class, $key, $label, $old_value, $id, $error_first){

      if($id == ""){
        $id = "";
      }else{
        $id = "id='".$id."'";
      }

       $old_value = __dataType::date_parse($old_value, 'm/d/Y');

      return '<div class="form-group col-md-'. $class .' " style="overflow:hidden;">
                <label for="'. $key .'">'. $label .'</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input '. $id .' name="'. $key .'" value="'. __sanitize::html_attribute_encode($old_value) .'" type="text" class="form-control datepicker" placeholder="mm/dd/yy">
                </div>
              </div>';

    }



    public static function timepicker($class, $key, $label, $old_value, $error_has, $error_first){

       return '<div class="col-md-'. $class .' bootstrap-timepicker">
                <div class="form-group '. self::error_response($error_has) .'">
                  <label>'. $label .'</label>
                  <div class="input-group">
                    <input id="'. $key .'" name="'. $key .'" value="'. __sanitize::html_attribute_encode($old_value) .'" type="text" class="form-control timepicker">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  '. self::error_message($error_has, $error_first) .'
                </div>
              </div>';

    }



    public static function file($class, $key, $id, $label, $error_has, $error_first, $extra_attr){

       return '<div class="form-group col-md-'. $class .' '. self::error_response($error_has) .'">
                <label for="'. $key .'">'. $label .'</label>
                <div class="file-loading">
                  <input class="file" name="'. $key .'" id="'. $id .'" type="file" '. $extra_attr .'>
                </div>
                '. self::error_message($error_has, $error_first) .'
              </div>';

    }




    /** Inlines **/
    public static function textbox_inline($key, $type, $label, $placeholder, $old_value, $error_has, $error_first, $extra_attr){

       return '<div class="form-group '. self::error_response($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="'. $type .'" value="'. __sanitize::html_attribute_encode($old_value) .'" placeholder="'. $placeholder .'" '. $extra_attr .'>
                    '. self::error_message($error_has, $error_first) .'
                  </div>
                </div>';

    }



    public static function password_inline($key, $label, $placeholder, $error_has, $error_first, $extra_attr){

       return '<div class="form-group '. self::error_response($error_has) .'">
                  <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="'. $key .'" id="'. $key .'" type="password" placeholder="'. $placeholder .'" '. $extra_attr .'>
                    '. self::error_message($error_has, $error_first) .'
                  </div>
                  <div class="col-sm-2">
                    <div class="checkbox">
                        <label>
                            <input name="show_'. $key .'" id="show_'. $key .'" type="checkbox"> Show
                        </label>
                    </div>
                  </div>
                </div>';
    }



    public static function select_dynamic_inline($key, $label, $old_value, $array, $var1, $var2, $error_has, $error_first, $select2, $extra_attr){
      
       return '<div class="form-group '. self::error_response($error_has) .'">
                <label for="'. $key .'" class="col-sm-2 control-label">'. $label .'</label>
                <div class="col-sm-10">
                  <select name="'. $key .'" id="'. $key .'" class="form-control '. $select2 .'" '. $extra_attr .'>
                    <option value="">Select</option>
                    '. self::dynamic_options($array, $var1, $var2, $old_value) .'
                  </select>
                  '. self::error_message($error_has, $error_first) .'
                </div>
              </div>';
                
    }

    public static function textbox_tbl_sm($class, $key, $type , $placeholder, $value, $extra_attr){
      return '
        <div class="form-group  '.$class.' no-margin">
          <input class="form-control input-sm " name="'.$key.'" type="'.$type.'" value="'.$value.'" '.$extra_attr.' > 
        </div>
       ';
    }

    /** For Filters **/

    public static function select_static_for_filter($class, $key, $label, $old_value, $array, $form, $select2, $extra_attr){
      
      $string = "'";

       return '<div class="form-group col-md-'. $class .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control input-md '. $select2 .'" onchange="document.getElementById('. $string .''. $form .''. $string .').click()" '. $extra_attr .'>
                  <option value="">Select</option>
                  '. self::static_options($array, $old_value) .'
                </select>
              </div>';
                
    }




    public static function select_dynamic_for_filter($class, $key, $label, $old_value, $array, $var1, $var2, $form, $select2, $extra_attr){
      
      $string = "'";

       return '<div class="form-group col-md-'. $class .'">
                <label for="'. $key .'">'. $label .'</label>
                <select name="'. $key .'" id="'. $key .'" class="form-control input-md '. $select2 .'" onchange="document.getElementById('. $string .''. $form .''. $string .').click()" '. $extra_attr .'>
                  <option value="">Select</option>
                  '. self::dynamic_options($array, $var1, $var2, $old_value) .'
                </select>
              </div>';
                
    }
    




    /** For Dynamic Tables **/

    public static function textbox_for_dt($name, $placeholder, $value, $error_first){

       return '<div class="form-group">
                  <input type="text" name="'. $name .'" class="form-control" placeholder="'. $placeholder .'" value="'. __sanitize::html_attribute_encode($value) .'">
                  <small class="text-danger">'. $error_first .'</small>
                </div>';

    }




    public static function textbox_numeric_for_dt($name, $placeholder, $value, $error_first){

       return '<div class="form-group">
                  <input type="text" name="'. $name .'" class="form-control priceformat" placeholder="'. $placeholder .'" value="'. __sanitize::html_attribute_encode($value) .'">
                  <small class="text-danger">'. $error_first .'</small>
                </div>';

    }




    public static function datepicker_for_dt($name, $value, $error_first){

       $value = __dataType::date_parse($value, 'm/d/Y');

       return '<div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input name="'. $name .'" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="'. __sanitize::html_attribute_encode($value) .'">
                  </div>
                  <small class="text-danger">'. $error_first .'</small>
                </div>';

    }




    public static function select_static_for_dt($name, $array, $value, $error_first){

       return '<div class="form-group">
                  <select name="'. $name .'" class="form-control">
                    <option value="">Select</option>
                    '. self::static_options($array, $value) .'
                  </select>
                  <small class="text-danger">'. $error_first .'</small>
                </div>';

    }




    /** UTILITY METHODS **/ 


    public static function string_value($value){

        $value = isset($value) ? $value : '';
        return $value;

    }


    public static function error_response($error_has){

      return $error_has ? 'has-error' : '';

    }



    public static function error_message($error_has, $error_first){

      if($error_has){

        return '<p class="help-block"> '. $error_first .' </p>';

      }

    }



    public static function static_options($array, $old_value){

      $string = '';

      foreach($array as $item => $value){

        $condition = $value == $old_value ? 'selected' : '';

        $string .= '<option value="'. $value .'" '. $condition .'>'. $item .'</option>';

      }

      return $string;

    }



    public static function dynamic_options($array, $var1, $var2, $old_value){

      $string = '';

      foreach($array as $value){

        $condition = $value->$var1 == $old_value ? 'selected' : '';
        
        $string .= '<option value="'. $value->$var1 .'" '. $condition .'>'. $value->$var2 .'</option>';

      }

      return $string;

    }

    public static function select_year($length, $label, $name, $array , $value, $attr, $class = null ){
        if($class != null){
            $fg_class = "fg-".$class;
            $input_class = "input-".$class;
        }else{
            $fg_class = '';
            $input_class = '';
        }
        $year_now =Carbon::now()->year;
        $start_year = $year_now-8;
        $end_year =$year_now+5;


        while ($start_year <= $end_year) {
            $arr[$start_year]= $start_year;

            $start_year++;
        }
        //return print_r($arr);
        $options = '';
        foreach ($arr as $option => $val) {

            if($value == ''){
                if($val == $year_now){
                    $options = $options.'<option value="'.$val.'" selected>'.$option.'</option>';
                }
            }
            if($value === $val){
                $options = $options.'<option value="'.$val.'" selected>'.$option.'</option>';
            }else{
                $options = $options.'<option value="'.$val.'">'.$option.'</option>';
            }
        }

        return '<div class="form-group col-md-'.$length.' '.$fg_class.'" id="fg-'.$name.'">
        <label for="is_menu">'.$label.'</label>
        <select name="'.$name.'" class="form-control '.$input_class.'" '.$attr.'">
          <option value="">Select</option>
          '.$options.'
        </select>  
      </div>';
    }

}