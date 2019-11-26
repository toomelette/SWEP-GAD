<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\SeminarInterface;
use App\Core\Interfaces\SeminarSpeakerInterface;
use App\Core\BaseClasses\BaseService;


class SeminarService extends BaseService{


    protected $seminar_repo;
    protected $seminar_speaker_repo;



    public function __construct(SeminarInterface $seminar_repo, SeminarSpeakerInterface $seminar_speaker_repo){

        $this->seminar_repo = $seminar_repo;
        $this->seminar_speaker_repo = $seminar_speaker_repo;
        parent::__construct();

    }





    public function fetch($request){

        $seminars = $this->seminar_repo->fetch($request);

        $request->flash();
        return view('dashboard.seminar.index')->with('seminars', $seminars);

    }






    public function store($request){

        $filename = $request->title .'-'. $this->str->random(8);

        $filename = $this->filterReservedChar($filename);

        if(!is_null($request->file('doc_file'))){
            $request->file('doc_file')->storeAs('', $filename);
        }
       
        $seminar = $this->seminar_repo->store($request, $filename);
            
        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $seminar_speaker = $this->seminar_speaker_repo->store($row, $seminar);
            }
        }

        $this->event->fire('seminar.store');
        return redirect()->back();

    }








    public function viewAttendanceSheet($slug){

        $seminar = $this->seminar_repo->findbySlug($slug);

        if(!empty($seminar->attendance_sheet_filename)){

            $path = $this->__static->archive_dir() .'/'. $seminar->attendance_sheet_filename;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        return abort(404);
        

    }





    public function edit($slug){

        $seminar = $this->seminar_repo->findbySlug($slug);
        return view('dashboard.seminar.edit')->with('seminar', $seminar);

    }






    public function update($request, $slug){

        $seminar = $this->seminar_repo->findBySlug($slug);    
        $filename = $this->filename($request, $seminar);

        $old_filename = $seminar->attendance_sheet_filename;
        $new_filename = $this->filterReservedChar($filename);

        // If theres new file upload
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_filename)) {

                $this->storage->disk('local')->delete($old_filename);

            }
            
            $request->file('doc_file')->storeAs('', $new_filename);

        }else{

            if ($request->title != $seminar->title && $this->storage->disk('local')->exists($old_filename)) {

                $this->storage->disk('local')->move($old_filename, $new_filename);

            }

        }

        $seminar = $this->seminar_repo->update($request, $filename, $seminar);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $seminar_speaker = $this->seminar_speaker_repo->store($row, $seminar);
            }
        }

        $this->event->fire('seminar.update', $seminar);
        return redirect()->route('dashboard.seminar.index');

    }






    public function destroy($slug){

        $seminar = $this->seminar_repo->destroy($slug);

        if(!is_null($seminar->attendance_sheet_filename)){

            if ($this->storage->disk('local')->exists($seminar->attendance_sheet_filename)) {
                $this->storage->disk('local')->delete($seminar->attendance_sheet_filename);
            }

        }

        $this->event->fire('seminar.destroy', $seminar);
        return redirect()->back();

    }





    private function filename($request, $seminar){

        $filename = $seminar->attendance_sheet_filename;
        
        if($request->title != $seminar->title){
            $filename = $request->title .'-'. $this->str->random(8);
        }

        return $this->filterReservedChar($filename);

    }






    private function filterReservedChar($filename){

        $filename = str_replace('.pdf', '', $filename);
        $filename = $this->str->limit($filename, 150);
        $filename = str_replace(['?', '%', '*', ':', ';', '|', '"', '<', '>', '.', '//', '/'], '', $filename);
        $filename = stripslashes($filename);

        return $filename .'.pdf';

    }






}