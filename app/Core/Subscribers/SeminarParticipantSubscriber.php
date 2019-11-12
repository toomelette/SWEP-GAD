<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SeminarparticipantSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('seminar_participant.store', 'App\Core\Subscribers\SeminarparticipantSubscriber@onStore');
        $events->listen('seminar_participant.update', 'App\Core\Subscribers\SeminarparticipantSubscriber@onUpdate');
        $events->listen('seminar_participant.destroy', 'App\Core\Subscribers\SeminarparticipantSubscriber@onDestroy');

    }




    public function onStore($seminar_participant){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:participants:fetchBySeminarId:'. $seminar_participant->seminar_id .'');

        $this->session->flash('SEMINAR_PTCPT_CREATE_SUCCESS', 'The Participant has been successfully created!');
        $this->session->flash('SEMINAR_PTCPT_CREATE_SUCCESS_SLUG', $seminar_participant->slug);

    }





    public function onUpdate($seminar_participant){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:participants:fetchBySeminarId:'. $seminar_participant->seminar_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:participants:getBySlug:'. $seminar_participant->slug .'');

        $this->session->flash('SEMINAR_PTCPT_UPDATE_SUCCESS', 'The Participant has been successfully updated!');
        $this->session->flash('SEMINAR_PTCPT_UPDATE_SUCCESS_SLUG', $seminar_participant->slug);

    }



    public function onDestroy($seminar_participant){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:participants:fetchBySeminarId:'. $seminar_participant->seminar_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:participants:getBySlug:'. $seminar_participant->slug .'');

        $this->session->flash('SEMINAR_PTCPT_DELETE_SUCCESS', 'The Participant has been successfully updated!');
        $this->session->flash('SEMINAR_PTCPT_DELETE_SUCCESS_SLUG', $seminar_participant->slug);

    }





}