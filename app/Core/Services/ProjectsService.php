<?php


namespace App\Core\Services;


use App\Core\BaseClasses\BaseService;
use App\Core\Repositories\ProjectsRepository;

class ProjectsService extends BaseService
{
    protected $projects_repo;
    public function __construct(ProjectsRepository $projects_repo)
    {
        $this->projects_repo = $projects_repo;
    }

    public function store($request){
        return $this->projects_repo->store($request);
    }
}