<?php


namespace App\Http\Controllers;


use App\Core\Services\OtherActivitiesService;
use App\Http\Requests\OtherActivities\OtherActivitiesFormRequest;
use Illuminate\Http\Request;

class OtherActivitiesController extends Controller
{
    protected $other_activities_service;

    public  function __construct(OtherActivitiesService $other_activities_service)
    {
        $this->other_activities_service = $other_activities_service;
    }

    public function index(){
        return view('dashboard.other_activities.index');
    }

    public function store(OtherActivitiesFormRequest $request){
        return $this->other_activities_service->store($request);
    }
}