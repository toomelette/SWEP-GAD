<?php

namespace App\Core\Interfaces;
 


interface BFEncounteredProblemInterface {

	public function fetch($request);

	public function store($problem_slug, $block_farm_slug);

	public function update($request, $filename, $seminar);

	public function destroy($block_farm_slug);

	public function findBySlug($slug);
		
}