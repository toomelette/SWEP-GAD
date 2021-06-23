<?php


namespace App\Core\Repositories;


use App\Core\BaseClasses\BaseRepository;

use App\Models\Projects;

class ProjectsRepository extends BaseRepository
{
    protected $projects;

    public function __construct(Projects $projects)
    {
        $this->projects = $projects;
        parent::__construct();
    }

    public function fetchTable($data){
        return Projects::with(['seminars']);
    }

    public function store($request){
        //return $r = $request;
        $project = New Projects;
        $project->slug = $this->str->random(16);

        foreach ($request->except('_token') as $key => $val) {
            $project->$key = $val;
        }

        if($project->save()){
            return $project->only(['slug']);
        }
    }


}