<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;


use App\Core\Interfaces\SeminarParticipantInterface;
use Illuminate\Http\Request;




class ApiSeminarController extends Controller{




	protected $seminar_participant_repo;





	public function __construct(SeminarParticipantInterface $seminar_participant_repo){

		$this->seminar_participant_repo = $seminar_participant_repo;

	}





    public function editParticipant(Request $request, $slug){

    	if($request->Ajax()){
    		$response_seminar_participant = $this->seminar_participant_repo->getBySlug($slug);
	    	return json_encode($response_seminar_participant);
	    }

	    return abort(404);

    }

	




    
}
