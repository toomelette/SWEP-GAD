<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Core\Services\ProfileService;
use App\Http\Requests\Profile\ProfileUpdateAccountUsernameRequest;
use App\Http\Requests\Profile\ProfileUpdateAccountPasswordRequest;
use App\Http\Requests\Profile\ProfileUpdateAccountColorRequest;


class ProfileController extends Controller{



	protected $profile_service; 



    public function __construct(ProfileService $profile_service){

        $this->profile_service = $profile_service;

    }




	public function details(){

        if(request()->ajax())
        {   
            $data = request();
            if(!empty($data->date_range)){
                if($data->date_range != ''){
                    $data->start_date = date("Y-m-d",strtotime(substr($data->date_range, 0, 10)));
                    $data->end_date = date("Y-m-d",strtotime(substr($data->date_range, -10)));
                }
            }

            return datatables()->of($this->profile_service->fetchTable($data))
            ->editColumn('module', function($data){
                switch ($data->module) {
                    case 'seminar':
                        return "Seminars";
                        break;
                    case 'block_farm':
                        return "Block Farm";
                        break;
                    case 'scholar':
                        return "Scholars";
                        break;
                    case 'bf_member':
                        return "Block Farm Member";
                        break;
                    default:
                        return $data->module;
                        break;
                }
            })
            ->editColumn('event',function($data){
                switch ($data->event) {
                    case 'store':
                        return '<span class="label bg-blue col-md-12">ADD </span>';
                        break;
                    case 'update':
                        return '<span class="label bg-green col-md-12">EDIT </span>';
                        break;
                    case 'destroy':
                        return '<span class="label bg-red col-md-12">DELETE </span>';
                        break;

                    default:
                        return '<span class="label bg-purple col-md-12">'.$data->event.' </span>';
                        break;
                }
            })
            ->editColumn('created_at', function($data){
                return date("M. d, 'y | h:i A", strtotime($data->created_at));
            })
            ->editColumn('created_at_raw', function($data){
                return $data->created_at;
            })
            ->escapeColumns([])
            ->setRowId('id')
            ->make();
        }
        $modules = $this->profile_service->modules();
        $events = $this->profile_service->events();
        $total_encoded = $this->profile_service->total_encoded();
        $total_updated = $this->profile_service->total_updated();
        return view('dashboard.profile.details')->with([
            'total_encoded' => $total_encoded, 
            'total_updated' => $total_updated,
            'modules' => $modules,
            'events' => $events
        ]);
        
    }




    public function updateAccountUsername(ProfileUpdateAccountUsernameRequest $request){

        return $this->profile_service->updateAccountUsername($request);
        
    }




    public function updateAccountPassword(ProfileUpdateAccountPasswordRequest $request){

        return $this->profile_service->updateAccountPassword($request);
        
    }


    

    public function updateAccountColor(){
        $color = request()->get('color');
        return $this->profile_service->updateAccountColor($color);
        
    }


    

    public function printPds($slug, $page){

        return $this->profile_service->printPds($slug, $page);
        
    }


    public function updateImage(Request $request){
        //$image = $request->file('avatar');
        $profile = $this->profile_service->updateImage($request);
        //$image->move(public_path('images/profile_images'), 'haru.jpg');

        return $profile;
    }



}
