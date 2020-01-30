<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\ProfileInterface;
use App\Core\Interfaces\UserInterface;


use Hash;


class ProfileRepository extends BaseRepository implements ProfileInterface {
	


    protected $user_repo;



	public function __construct(UserInterface $user_repo){

        $this->user_repo = $user_repo;
        parent::__construct();

    }






    public function updateUsername($request){

        $user_id = $this->auth->user()->slug;

        $user = $this->user_repo->findBySlug($user_id);
        $user->username = $request->username;
        $user->save();

        return $user;

    }





    public function updatePassword($request){
        $user_id = $this->auth->user()->slug;
        $user = $this->user_repo->findBySlug($user_id);
        $user->password = Hash::make($request->password);
        //$user->is_online = 0;
        $user->save();

        return $user;

    }





    public function updateColor($color){
        $user_id = $this->auth->user()->slug;

        $user = $this->user_repo->findBySlug($user_id);

        $user->color = $color;
        $user->save();

        return $user->color;

    }

    public function total_encoded(){

        return $this->user_repo->total_encoded();
    }

        public function total_updated(){

        return $this->user_repo->total_updated();
    }





}