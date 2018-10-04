<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Subjects;
use App\Posts;
use App\UpVotes;
use App\Comments;

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
        $subjects = Subjects::where("type", $subjectType)->limit(60)->get();
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
            'subjectQuote' => 'required|max:200',
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
        $request->validate([
            'subjectName' => 'required|max:50',
            'subjectQuote' => 'required|max:200',
            'subjectOpen' => 'required',
        ]);

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

    public function subjectVisitingSite($subjectID){
        $posts = Posts::where("subject_id", $subjectID)->orderBy("id", "desc")->get();
        $subject = Subjects::where("id", $subjectID)->first();
        $postsLikeCount = array();
        $postsLikedByUser = array();
        $postsCommentCount = array();
        $postsLike = Posts::where("subject_id", $subjectID)
            ->orderBy("posts.id", "desc")
            ->join("up_votes", "up_votes.target_id", "=", "posts.id")
            ->where("target_type", 1)
            ->select("target_id", "up_votes.user_id")
            ->get();
        foreach($postsLike as $like){
            if(!isset($postsLikeCount[$like->target_id])){
                $postsLikeCount[$like->target_id] = 0;
            }
            $postsLikeCount[$like->target_id]++;
            if($like->user_id == Auth::user()->id){
                $postsLikedByUser[$like->target_id] = 1;
            }
        }
        $postsComment = Posts::where("subject_id", $subjectID)
            ->orderBy("posts.id", "desc")
            ->join("comments", "comments.post_id", "=", "posts.id")
            ->select("post_id")
            ->get();
        foreach($postsComment as $cmt){
            if(!isset($postsCommentCount[$cmt->post_id])){
                $postsCommentCount[$cmt->post_id] = 0;
            }
            $postsCommentCount[$cmt->post_id]++;
        }
        $data = array(
            "postsCommentCount" => $postsCommentCount,
            "postsLikeCount" => $postsLikeCount,
            "postsLikedByUser" => $postsLikedByUser,
            "subject" => $subject,
            "posts" => $posts,
        );
        #return $data;
        return view("subjectsCtrl.visit")->with($data);
    }

    public function checkSubjectPermission($subjectID){
        if(Auth::user()->type == 3) return 1;
        $ownerID = Subjects::where("id", $subjectID)->first()->user_id;
        if($ownerID!=Auth::user()->id){
            return 0;
        }
        return 1;
    }
}
