<?php

namespace App\Core\Interfaces;
 


interface ProfileInterface {

	public function updateUsername($request);

	public function updatePassword($request);

	public function updateColor($color);
		
}