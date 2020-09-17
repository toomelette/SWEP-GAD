<?php

namespace App\Core\Interfaces;
 


interface CommitteeMembersInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($menu_id);


	public function getAll();
		
}