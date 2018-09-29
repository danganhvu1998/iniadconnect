<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Subjects;

class SubjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function subjectSchoolViewingSite(){
        return $this->subjectViewingSite(0);
    }

    public function subjectProjectViewingSite(){
        return $this->subjectViewingSite(1);
    }

    public function subjectViewingSite($subjectType){
        $subjects = Subjects::where("type", $subjectType)->get();
        $data = array(
            "subjectType" => $subjectType,
            "subjects" => $subjects
        );
        return view("subjectsCtrl.viewList")->with($data);
    }

    public function subjectAddingSite($subjectType){
        return view("subjectsCtrl.add")->with("subjectType", $subjectType);
    }

    public function subjectAdding(request $request){
        if($request->subjectType!=1 && Auth::user()->type!=3){
            return back()->withErrors("Permission Denied");
        }

        $request->validate([
            'subjectName' => 'required|max:50',
            'subjectQuote' => 'required|max:255 ',
            'subjectType' => 'required',
            'subjectOpen' => 'required',
        ]);

        $subject = new Subjects;
        $subject->user_id = Auth::User()->id;
        $subject->name = $request->subjectName;
        $subject->quote = $request->subjectQuote;
        $subject->open = $request->subjectOpen;
        $subject->type = $request->subjectType;
        $subject->save();
        return redirect("/project/view")->with("message", "messages.success");
    }

    public function subjectEdittingSite($subjectID){
        if(!$this->checkSubjectPermission($subjectID)){
            return back()->withErrors("Permission Denied");
        }
        $subject = Subjects::where("id", $subjectID)->first();
        return view("subjectsCtrl.edit")->with("subject", $subject);
    }

    public function subjectEdittingInfo(request $request){
        if(!$this->checkSubjectPermission($request->subjectID)){
            return back()->withErrors("Permission Denied");
        }
        Subjects::where("id", $request->subjectID)
            ->update([
                "name" => $request->subjectName,
                "quote" => $request->subjectQuote,
                "open" => $request->subjectOpen,
            ]);
        return back()->with("message", "messages.informationChanged");
    }

    public function subjectEdittingImage(request $request){
        if(!$this->checkSubjectPermission($request->subjectID)){
            return back()->withErrors("Permission Denied");
        }
        $request->validate([
            'file' => 'required|image',
        ]);
        $subject = Subjects::where("id", $request->subjectID)->first();
        $subjectID = $subject->id;
        $subjectImage = $subject->image;
        //Delete Cover Image
        Storage::delete('public/file/'.$subjectImage);

        if($request->hasFile('file')){
            // Filename to store
            $fileNameToStore = 'subject_image_'.time().'_'.$request->file('file')->getClientOriginalName();
            // Upload File
            $path = $request->file('file')->storeAs('public/file', $fileNameToStore);

            Subjects::where("id", $request->subjectID)
                ->update(["image" => $fileNameToStore]);
            return back()->with("message", "messages.informationChanged");
        }
    }

    public function subjectEdittingCoverImage(request $request){
        if(!$this->checkSubjectPermission($request->subjectID)){
            return back()->withErrors("Permission Denied");
        }
        $request->validate([
            'file' => 'required|image',
        ]);
        $subject = Subjects::where("id", $request->subjectID)->first();
        $subjectID = $subject->id;
        $subjectCoverImage = $subject->cover_image;
        //Delete Cover Image
        Storage::delete('public/file/'.$subjectCoverImage);

        if($request->hasFile('file')){
            // Filename to store
            $fileNameToStore = 'subject_cover_image_'.time().'_'.$request->file('file')->getClientOriginalName();
            // Upload File
            $path = $request->file('file')->storeAs('public/file', $fileNameToStore);

            Subjects::where("id", $request->subjectID)
                ->update(["cover_image" => $fileNameToStore]);
            return back()->with("message", "messages.informationChanged");
        }
    }

    public function checkSubjectPermission($subjectID){
        $ownerID = Subjects::where("id", $subjectID)->first()->user_id;
        if($ownerID!=Auth::user()->id){
            return 0;
        }
        return 1;
    }
}
