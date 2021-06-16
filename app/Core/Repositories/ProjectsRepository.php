<?php


namespace App\Core\Repositories;


use App\Core\BaseClasses\BaseRepository;
use App\Models\Projects;

class ProjectsRepository extends BaseRepository
{
    public function store($request){
        //return $r = $request;
        $project = New Projects;
        //$project->activity = $r->activity;

        foreach ($request->except('_token') as $key => $val) {
            $project->$key = $val;
        }

        if($project->save()){
            return 1;
        }
    }
}