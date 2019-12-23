<?php

namespace App\Core\Interfaces;
 


interface BlockFarmProblemInterface {

	public function fetch();

	public function store($request, $filename);

	public function update($request, $filename, $seminar);

	public function destroy($slug);

	public function findBySlug($slug);
		
}