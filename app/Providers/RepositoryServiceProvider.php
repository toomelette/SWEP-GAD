<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
 

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Core\Interfaces\UserInterface', 'App\Core\Repositories\UserRepository');
		$this->app->bind('App\Core\Interfaces\UserMenuInterface', 'App\Core\Repositories\UserMenuRepository');
		$this->app->bind('App\Core\Interfaces\UserSubmenuInterface', 'App\Core\Repositories\UserSubmenuRepository');

		$this->app->bind('App\Core\Interfaces\MenuInterface', 'App\Core\Repositories\MenuRepository');
		$this->app->bind('App\Core\Interfaces\SubmenuInterface', 'App\Core\Repositories\SubmenuRepository');

		$this->app->bind('App\Core\Interfaces\ProfileInterface', 'App\Core\Repositories\ProfileRepository');


		// GAD Modules

		$this->app->bind('App\Core\Interfaces\SeminarInterface', 'App\Core\Repositories\SeminarRepository');
		$this->app->bind('App\Core\Interfaces\SeminarParticipantInterface', 'App\Core\Repositories\SeminarParticipantRepository');
		$this->app->bind('App\Core\Interfaces\SeminarSpeakerInterface', 'App\Core\Repositories\SeminarSpeakerRepository');

		$this->app->bind('App\Core\Interfaces\BlockFarmInterface', 'App\Core\Repositories\BlockFarmRepository');

		$this->app->bind('App\Core\Interfaces\BlockFarmProblemInterface', 'App\Core\Repositories\BlockFarmProblemRepository');

		$this->app->bind('App\Core\Interfaces\BFEncounteredProblemInterface', 'App\Core\Repositories\BFEncounteredProblemRepository');

		$this->app->bind('App\Core\Interfaces\ScholarsInterface', 'App\Core\Repositories\ScholarsRepository');


	}



}