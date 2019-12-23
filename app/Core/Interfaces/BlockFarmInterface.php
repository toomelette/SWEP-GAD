<?php

namespace App\Core\Interfaces;
 


interface BlockFarmInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $seminar);

	public function destroy($slug);

	public function findBySlug($slug);
		
}