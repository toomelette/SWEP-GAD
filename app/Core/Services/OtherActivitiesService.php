<?php


namespace App\Core\Services;


use App\Core\BaseClasses\BaseService;
use App\Core\Helpers\GlobalHelpers;
use App\Core\Repositories\OtherActivitiesRepository;

class OtherActivitiesService extends BaseService
{
    protected $other_activities_repo;
    public function __construct(OtherActivitiesRepository $other_activities_repo)
    {
        $this->other_activities_repo = $other_activities_repo;
        parent::__construct();
    }

    public function store($request){
        $request->merge([
            'utilized_fund' => GlobalHelpers::sanitize_autonum($request->utilized_fund)
        ]);
        return $this->other_activities_repo->store($request);
    }

    public function update($request,$id){
        $request->merge([
            'utilized_fund' => GlobalHelpers::sanitize_autonum($request->utilized_fund)
        ]);
        return $this->other_activities_repo->update($request,$id);
    }
}