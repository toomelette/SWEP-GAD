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

       //  $seminar = $this->seminar_repo->findBySlug($slug);

       // return $seminar;

    }




    public function store($request, $slug){

        $seminar_participant = $this->seminar_participant_repo->store($request, $slug);

        $this->event->fire('seminar_participant.store', $seminar_participant);
        $insert_id = $seminar_participant->id;
        
        

        return json_encode(
            array(
                'result' => 1, 
                'slug' => $slug,
                'inserted_participant' => $seminar_participant->slug,
                'fullname' => $seminar_participant->fullname,
                'address' => $seminar_participant->address,
                'sex' => $seminar_participant->sex,
                'contact_no' => $seminar_participant->contact_no,
                'email' => $seminar_participant->email
            )
        ) ;

    }

    public function edit($slug){
        
        $seminar_participant = $this->seminar_participant_repo->findBySlug($slug);
        return $seminar_participant;
    }


    public function update($request ,$sem_ptcpt_slug){

        $seminar_participant = $this->seminar_participant_repo->update($request, $sem_ptcpt_slug);

        $this->event->fire('seminar_participant.update', $seminar_participant);

        return json_encode(
            array(
                'result' => 1,
                'slug' => $sem_ptcpt_slug,
                'e_fullname' => $request->e_fullname,
                'e_address' => $request->e_address,
                'e_sex' => $request->e_sex,
                'e_contact_no' => $request->e_contact_no,
                'e_email' => $request->e_email
            )
        );
        // return redirect()->route('dashboard.seminar.participant', $sem_slug);

    }




    public function destroy($slug){

        $seminar_participant = $this->seminar_participant_repo->destroy($slug);

        $this->event->fire('seminar_participant.destroy', $seminar_participant);
        return json_encode(
            array(
                'result' => 1
            )
        );

    }






}