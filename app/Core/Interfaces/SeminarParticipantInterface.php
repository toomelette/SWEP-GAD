<?php

namespace App\Core\Interfaces;
 


interface SeminarParticipantInterface {

	public function fetchBySeminarId($slug);

	public function store($request, $slug);

	public function update($request, $sem_ptcpt_slug);

	public function getBySlug($slug);

}