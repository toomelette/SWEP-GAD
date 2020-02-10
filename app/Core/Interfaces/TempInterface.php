<?php

namespace App\Core\Interfaces;
 


interface TempInterface {

	public function store($request);
	
	public function findBySubmenuId($submenu_id);

	public function findBySlug($slug);

	public function getAll();

	public function getByMenuId($menu_id);

	public function edit($slug);
 	
 	public function update($request, $slug);
	
	public function destroy($slug);
		
}