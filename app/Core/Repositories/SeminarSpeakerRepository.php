<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SeminarSpeakerInterface;


use App\Models\SeminarSpeaker;


class SeminarSpeakerRepository extends BaseRepository implements SeminarSpeakerInterface {
	



    protected $seminar_speaker;




	public function __construct(SeminarSpeaker $seminar_speaker){

        $this->seminar_speaker = $seminar_speaker;
        parent::__construct();

    }






    public function store($data, $seminar){

        $seminar_speaker = new SeminarSpeaker;
        $seminar_speaker->seminar_id = $seminar->seminar_id;
        $seminar_speaker->seminar_speaker_id = $this->getSeminarSpeakerIdInc();
        $seminar_speaker->fullname = $data['spkr_fullname'];
        $seminar_speaker->topic = $data['spkr_topic'];
        $seminar_speaker->save();
        
        return $seminar_speaker;

    }






    public function getSeminarSpeakerIdInc(){

        $id = 'SS100001';
        $seminar_speaker = $this->seminar_speaker->select('seminar_speaker_id')->orderBy('seminar_speaker_id', 'desc')->first();

        if($seminar_speaker != null){
            $num = str_replace('SS', '', $seminar_speaker->seminar_speaker_id) + 1;
            $id = 'SS' . $num;
        }
        
        return $id;
        
    }







}