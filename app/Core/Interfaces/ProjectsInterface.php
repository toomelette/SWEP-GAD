<?php

namespace App\Core\Interfaces;



interface ProjectsInterface {

    public function fetch($request);

    public function store($request);

    public function update($request, $slug);

    public function destroy($slug);

    public function findBySlug($menu_id);

    public function findByMenuId($menu_id);

    public function getAll();

}