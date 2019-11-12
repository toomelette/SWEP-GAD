<?php
 
namespace App\Core\Services;


use App\Core\Interfaces\SeminarInterface;
use App\Core\BaseClasses\BaseService;


class SeminarService extends BaseService{


    protected $seminar_repo;



    public function __construct(SeminarInterface $seminar_repo){

        $this->seminar_repo = $seminar_repo;
        parent::__construct();

    }





    public function fetch($request){

        $seminars = $this->seminar_repo->fetch($request);

        $request->flash();
        return view('dashboard.seminar.index')->with('seminars', $seminars);

    }






    public function store($request){
       
        $seminar = $this->seminar_repo->store($request);
        
        $this->event->fire('seminar.store');
        return redirect()->back();

    }






    public function edit($slug){

        $seminar = $this->seminar_repo->findbySlug($slug);
        return view('dashboard.seminar.edit')->with('seminar', $seminar);

    }






    public function update($request, $slug){

        $seminar = $this->seminar_repo->update($request, $slug);

        $this->event->fire('seminar.update', $seminar);
        return redirect()->route('dashboard.seminar.index');

    }






    public function destroy($slug){

        $seminar = $this->seminar_repo->destroy($slug);

        $this->event->fire('seminar.destroy', $seminar);
        return redirect()->back();

    }






}