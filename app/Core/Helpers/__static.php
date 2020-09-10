<?php

namespace App\Core\Helpers;



class __static{



    // Profile
    public static function user_colors(){

        return [

	      'Blue/Dark' => 'sidebar-mini skin-blue',
	      'White/Dark' => 'sidebar-mini skin-black',
	      'Purple/Dark' => 'sidebar-mini skin-purple',
	      'Green/Dark' => 'sidebar-mini skin-green',
	      'Red/Dark' => 'sidebar-mini skin-red',
	      'Yellow/Dark' => 'sidebar-mini skin-yellow',
	      'Blue/Light' => 'sidebar-mini skin-blue-light',
	      'White/Light' => 'sidebar-mini skin-black-light',
	      'Purple/Light' => 'sidebar-mini skin-purple-light',
	      'Green/Light' => 'sidebar-mini skin-green-light',
	      'Red/Light' => 'sidebar-mini skin-red-light',
	      'Yellow/Light' => 'sidebar-mini skin-yellow-light',

	    ];

    
    }

    public static function bg_color($color){

        $colors = [
	      'sidebar-mini skin-blue'=> 'bg-blue',
	      'sidebar-mini skin-black'=> 'bg-black',
	      'sidebar-mini skin-purple'=> 'bg-purple',
	      'sidebar-mini skin-green'=> 'bg-green',
	      'sidebar-mini skin-red'=> 'bg-red',
	      'sidebar-mini skin-yellow'=> 'bg-yellow',
	      'sidebar-mini skin-blue-light'=> 'bg-blue',
	      'sidebar-mini skin-black-light'=> 'bg-black',
	      'sidebar-mini skin-purple-light'=> 'bg-purple',
	      'sidebar-mini skin-green-light'=> 'bg-green',
	      'sidebar-mini skin-red-light'=> 'bg-red',
	      'sidebar-mini skin-yellow-light'=> 'bg-yellow',
	    ];

    	return $colors[$color];
    }


    public static function pagination_color($color){

        $colors = [

	      'sidebar-mini skin-blue'=> '#3C8DBC',
	      'sidebar-mini skin-black'=> '#000',
	      'sidebar-mini skin-purple'=> '#605CA8',
	      'sidebar-mini skin-green'=> '#00A65A',
	      'sidebar-mini skin-red'=> '#DD4B39',
	      'sidebar-mini skin-yellow'=> '#F39C12',
	      'sidebar-mini skin-blue-light'=> '#3C8DBC',
	      'sidebar-mini skin-black-light'=> '#000',
	      'sidebar-mini skin-purple-light'=> '#605CA8',
	      'sidebar-mini skin-green-light'=> '#00A65A',
	      'sidebar-mini skin-red-light'=> '#DD4B39',
	      'sidebar-mini skin-yellow-light'=> '#F39C12',

	    ];

    	return $colors[$color];
    }

    public static function loader($color){
    	$bg = __static::bg_color($color);
    	return asset('images/loaders/loader')."-".$bg.".gif";
    }

    // File Directories
    public static function archive_dir(){

        return '/home/swep_gad_storage/';
    
    }




}