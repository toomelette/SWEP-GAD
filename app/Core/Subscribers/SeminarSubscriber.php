<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SeminarSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('seminar.store', 'App\Core\Subscribers\SeminarSubscriber@onStore');
        $events->listen('seminar.update', 'App\Core\Subscribers\SeminarSubscriber@onUpdate');
        $events->listen('seminar.destroy', 'App\Core\Subscribers\SeminarSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:fetch:*');

        $this->session->flash('SEMINAR_CREATE_SUCCESS', 'The Seminar has been successfully created!');

    }





    public function onUpdate($seminar){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:findBySlug:'. $seminar->slug .'');

        $this->session->flash('SEMINAR_UPDATE_SUCCESS', 'The Seminar has been successfully updated!');
        $this->session->flash('SEMINAR_UPDATE_SUCCESS_SLUG', $seminar->slug);

    }



    public function onDestroy($seminar){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:findBySlug:'. $seminar->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:seminars:participants:fetchBySeminarId:'. $seminar->seminar_id .'');

        $this->session->flash('SEMINAR_DELETE_SUCCESS', 'The Seminar has been successfully deleted!');
        $this->session->flash('SEMINAR_DELETE_SUCCESS_SLUG', $seminar->slug);

    }





}