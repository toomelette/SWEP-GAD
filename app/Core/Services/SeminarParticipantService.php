<?php
 
namespace App\Core\Services;


use App\Core\BaseClasses\BaseService;
use App\Core\Interfaces\SeminarParticipantInterface;


class SeminarParticipantService extends BaseService{


    protected $seminar_participant_repo;



    public function __construct(SeminarParticipantInterface $seminar_participant_repo){

        $this->seminar_participant_repo = $seminar_participant_repo;
        parent::__construct();

    }




    public function index($slug){

        $seminar_participants = $this->seminar_participant_repo->fetchBySeminarId($slug);

        return view('dashboard.seminar.participants')->with($seminar_participants);

    }




    public function store($request, $slug){

        $seminar_participant = $this->seminar_participant_repo->store($request, $slug);

        $this->event->fire('seminar_participant.store', $seminar_participant);
        return redirect()->route('dashboard.seminar.participant', $slug);

    }




    public function update($request, $sem_slug ,$sem_ptcpt_slug){

        $seminar_participant = $this->seminar_participant_repo->update($request, $sem_ptcpt_slug);

        $this->event->fire('seminar_participant.update', $seminar_participant);
        return redirect()->route('dashboard.seminar.participant', $sem_slug);

    }




    public function destroy($slug){

        $seminar_participant = $this->seminar_participant_repo->destroy($slug);

        $this->event->fire('seminar_participant.destroy', $seminar_participant);
        return redirect()->back();

    }






}