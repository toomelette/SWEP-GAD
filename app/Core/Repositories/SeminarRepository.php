<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SeminarInterface;

use App\Models\Seminar;


class SeminarRepository extends BaseRepository implements SeminarInterface {
	


    protected $seminar;



	public function __construct(Seminar $seminar){

        $this->seminar = $seminar;
        parent::__construct();

    }





    public function fetch($request){

        // $cache_key = str_slug($request->fullUrl(), '_');
        // $entries = isset($request->e) ? $request->e : 20;

        // $seminars = $this->cache->remember('seminars:fetch:' . $cache_key, 240, function() use ($request, $entries){

        //     $seminar = $this->seminar->newQuery();
            
        //     if(isset($request->q)){ $this->search($seminar, $request->q); }

        //     return $this->populate($seminar, $entries);

        // });

        // return $seminars;

    }





    public function store($request){

        // $seminar = new Seminar;
        // $seminar->seminar_id = $this->getSeminarIdInc();
        // $seminar->slug = $this->str->random(16);
        // $seminar->name = $request->name;
        // $seminar->route = $request->route;
        // $seminar->category = $request->category;
        // $seminar->icon = $request->icon;
        // $seminar->is_seminar = $this->__dataType->string_to_boolean($request->is_seminar);
        // $seminar->is_dropdown = $this->__dataType->string_to_boolean($request->is_dropdown);
        // $seminar->created_at = $this->carbon->now();
        // $seminar->updated_at = $this->carbon->now();
        // $seminar->ip_created = request()->ip();
        // $seminar->ip_updated = request()->ip();
        // $seminar->user_created = $this->auth->user()->user_id;
        // $seminar->user_updated = $this->auth->user()->user_id;
        // $seminar->save();
        
        // return $seminar;

    }





    public function update($request, $slug){

        // $seminar = $this->findBySlug($slug);
        // $seminar->name = $request->name;
        // $seminar->route = $request->route;
        // $seminar->category = $request->category;
        // $seminar->icon = $request->icon;
        // $seminar->is_seminar = $this->__dataType->string_to_boolean($request->is_seminar);
        // $seminar->is_dropdown = $this->__dataType->string_to_boolean($request->is_dropdown);
        // $seminar->updated_at = $this->carbon->now();
        // $seminar->ip_updated = request()->ip();
        // $seminar->user_updated = $this->auth->user()->user_id;
        // $seminar->save();

        // return $seminar;

    }





    public function destroy($slug){

        // $seminar = $this->findBySlug($slug);
        // $seminar->delete();
        // $seminar->subseminar()->delete();

        // return $seminar;

    }





    public function findBySlug($slug){

        // $seminar = $this->cache->remember('seminars:findBySlug:' . $slug, 240, function() use ($slug){
        //     return $this->seminar->where('slug', $slug)->first();
        // }); 
        
        // if(empty($seminar)){ abort(404); }

        // return $seminar;

    }






    private function getSeminarIdInc(){

        $id = 'M10001';
        $seminar = $this->seminar->select('seminar_id')->orderBy('seminar_id', 'desc')->first();

        if($seminar != null){
            $num = str_replace('M', '', $seminar->seminar_id) + 1;
            $id = 'M' . $num;
        }
        
        return $id;
        
    }






    private function search($instance, $key){

        return $instance->where(function ($instance) use ($key) {
                    $instance->where('name', 'LIKE', '%'. $key .'%');        
        });

    }





    private function populate($instance, $entries){

        return $instance->select('name', 'route', 'icon', 'slug')
                        ->sortable()
                        ->orderBy('updated_at', 'desc')
                        ->paginate($entries);

    }






}