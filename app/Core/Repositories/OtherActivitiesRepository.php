<?php


namespace App\Core\Repositories;


use App\Core\BaseClasses\BaseRepository;
use App\Models\OtherActivities;

class OtherActivitiesRepository extends BaseRepository
{
    protected $other_activities;
    public function __construct(OtherActivities $other_activities)
    {
        $this->other_activities = $other_activities;
        parent::__construct();
    }
    public function fetchTable($data){
        return $this->other_activities->all();
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

    public function findBySlug($slug){
        return $this->other_activities->where('slug',$slug)->first();
    }
    public function update($request,$id){

        $other_act = $this->findBySlug($id);
        foreach ($request->except('_token') as $key => $value){
            $other_act->$key = $value;
        }
        if(empty($request->has_participants)){
            $other_act->has_participants = 0;
        }
        if($other_act->update()){
            return $other_act->only(['slug']);
        }
    }

    public function destroy($id){
        $other_act = $this->findBySlug($id);
        if($other_act->delete()){
            return $other_act->only(['slug']);
        }
    }
}