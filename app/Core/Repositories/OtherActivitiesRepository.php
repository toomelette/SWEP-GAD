<?php


namespace App\Core\Repositories;


use App\Core\BaseClasses\BaseRepository;
use App\Models\OtherActivities;

class OtherActivitiesRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store($request){
       $other_act = new OtherActivities;
       $other_act->slug = $this->str->random(24);
       foreach ($request->except('_token') as $key => $value){
           $other_act->$key = $value;
       }
       if($other_act->save()){
           return $other_act->only(['slug']);
       }

    }
}