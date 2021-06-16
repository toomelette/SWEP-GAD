<?php


namespace App\Http\Controllers;


use App\Core\Services\ProjectsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\ProjectFormRequest;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    protected $project_service;
    public function  __construct(ProjectsService $project_service)
    {
        $this->project_service = $project_service;
    }

    public function index(){
        return view('dashboard.projects.index');
    }

    public function store(ProjectFormRequest $request){
        return $this->project_service->store($request);
    }
}