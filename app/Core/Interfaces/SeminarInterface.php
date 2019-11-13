<?php

namespace App\Core\Interfaces;
 


interface SeminarInterface {

	public function fetch($request);

	public function store($request, $filename);

	public function update($request, $filename, $seminar);

	public function destroy($slug);

	public function findBySlug($slug);
		
}