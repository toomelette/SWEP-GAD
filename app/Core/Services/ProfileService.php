<?php
 
namespace App\Core\Services;

use Hash;
use App\Core\BaseClasses\BaseService;
use App\Core\Interfaces\ProfileInterface;
use App\Core\Interfaces\ActivityLogInterface;

class ProfileService extends BaseService{



    protected $profile_repo;
    protected $activity_log_repo;


    public function __construct(ProfileInterface $profile_repo,ActivityLogInterface $activity_log_repo){

        $this->profile_repo = $profile_repo;
        $this->activity_log_repo = $activity_log_repo;
        parent::__construct();

    }





    public function updateAccountUsername($request){

        $user = $this->profile_repo->updateUsername($request);
        return $user->username;
        //$this->session->flush();
        //$this->auth->logout();

        // $this->event->fire('profile.update_account_username', $user);
        // return redirect('/');

    }


    public function fetchTable($data){
        return $this->activity_log_repo->fetchTableUser($data);
    }



    public function updateAccountPassword($request){

        if(Hash::check($request->old_password, $this->auth->user()->password)){
          
            $user = $this->profile_repo->updatePassword($request);
            return 1;
            // $this->session->flush();
            // $this->auth->logout();

            //$this->event->fire('profile.update_account_password', $user);
            //return redirect('/');

        }else{
            return -1;
        }

        

    }






    public function updateAccountColor($color){
        return $this->profile_repo->updateColor($color);
    }

    public function total_encoded(){
        return $this->profile_repo->total_encoded();
    }

    public function total_updated(){
        return $this->profile_repo->total_updated();
    }

    public function modules(){
        return $this->activity_log_repo->modules();
    }

    public function events(){
        return $this->activity_log_repo->events();
    }

}