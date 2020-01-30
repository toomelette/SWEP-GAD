<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class ActivityLogs extends Model{


    public $timestamps = false;

    protected $table = 'activity_logs';

    protected $dates = ['created_at'];
    
	
    





    protected $attributes = [

        'module' => '',
        'event' => '',
        'user_id' => '',
        'slug' => '',
        'remarks' => '',
        'created_at' => null

    ];









}
