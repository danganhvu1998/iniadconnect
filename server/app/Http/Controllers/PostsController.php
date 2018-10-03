<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Posts;
use App\Subjects;
use App\Comments;
use App\UpVotes;



class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function postAdding(request $request){
        if(!$this->checkSubjectPermission($request->subjectID)){
            return back()->withErrors("Permission Denied");
        }
        $request->validate([
            'postTitle' => 'required|max:200',
            'file1' => 'image',
            'file2' => 'image',
        ]);

        $post = new Posts;
        $post->title = $request->postTitle;
        $post->content = $request->postContent;
        $post->user_id = Auth::user()->id;
        $post->subject_id = $request->subjectID;
        
        if($request->hasFile('file1')){
            // Filename to store
            $fileNameToStore = 'post_image_'.time().'_'.$request->file('file1')->getClientOriginalName();
            // Upload File
            $path = $request->file('file1')->storeAs('public/file', $fileNameToStore);
            $post->image = $fileNameToStore;
        }

        if($request->hasFile('file2')){
            // Filename to store
            $fileNameToStore = 'post_image_'.time().'_'.$request->file('file2')->getClientOriginalName();
            // Upload File
            $path = $request->file('file2')->storeAs('public/file', $fileNameToStore);
            $post->more_image = $fileNameToStore;
        }
        $post->save();
        return back()->with("message", "messages.success");
    }

    public function postEditingSite($postID){
        if(!$this->checkPostPermission($postID)){
            return back()->withErrors("Permission Denied");
        }
        $post = Posts::where("id", $postID)->first();
        return view("postsCtrl.edit")->with("post", $post);

    }

    public function postEditing(request $request){
        if(!$this->checkPostPermission($request->postID)){
            return back()->withErrors("Permission Denied");
        }
        $request->validate([
            'postTitle' => 'required|max:200',
            'file1' => 'image',
            'file2' => 'image',
        ]);
        $post = Posts::where("id", $request->postID)->first();
        Posts::where("id", $request->postID)
            ->update([
                "title" => $request->postTitle,
                "content" => $request->postContent,
            ]);

        if($request->hasFile('file1')){
            // Filename to store
            $fileNameToStore = 'post_image_'.time().'_'.$request->file('file1')->getClientOriginalName();
            // Upload File
            $path = $request->file('file1')->storeAs('public/file', $fileNameToStore);
            Storage::delete('public/file/'.$post->image);
            Posts::where("id", $request->postID)
                ->update(["image" => $fileNameToStore]);
        }

        if($request->hasFile('file2')){
            // Filename to store
            $fileNameToStore = 'post_image_'.time().'_'.$request->file('file2')->getClientOriginalName();
            // Upload File
            $path = $request->file('file2')->storeAs('public/file', $fileNameToStore);
            Storage::delete('public/file/'.$post->more_image);
            Posts::where("id", $request->postID)
                ->update(["more_image" => $fileNameToStore]);
        }
        return back()->with("message", "messages.informationChanged");
    }

    public function postViewingSiteAA($postID){
        $post = Posts::where("id", $postID)->first();
        $comments = Comments::where("post_id", $postID)
            ->join("users", "users.id", "=", "comments.user_id")
            ->select("users.name as user_name", "users.image as user_image", "comments.*")
            ->get();
        $subject = Subjects::where("id", $post->subject_id)->first();
        $data = array(
            "post" => $post,
            "comments" => $comments,
            "subject" => $subject,
        );
        return view("postsCtrl.view")->with($data);
    }

    public function postViewingSite($postID){
        $post = Posts::where("id", $postID)->first();
        $subject = Subjects::where("id", $post->subject_id)->first();
        $comments = Comments::where("post_id", $postID)
            ->join("users", "users.id", "=", "comments.user_id")
            ->select("users.name as user_name", "users.image as user_image", "comments.*")
            ->get();
        $commentsLikes = Comments::where("post_id", $postID)
            ->join("users", "users.id", "=", "comments.user_id")
            ->join("up_votes", "up_votes.target_id", "=", "comments.id")#
            ->where("up_votes.target_type", 2)#
            ->select("target_id", "up_votes.user_id")
            ->get(); 
        $commentsLikeCount = array();
        $commentsLikedByUser = array();
        foreach($commentsLikes as $like){
            if(!isset($commentsLikeCount[$like->target_id])){
                $commentsLikeCount[$like->target_id] = 0;
            }
            $commentsLikeCount[$like->target_id]++;
            if($like->user_id == Auth::user()->id){
                $commentsLikedByUser[$like->target_id] = 1;
            }
        }
        $postLikeCount = Upvotes::where("target_type", 1)
            ->where("target_id", $postID)
            ->count();
        $postLiked = $this->checkUpvote(1, $postID);
        $data = array(
            "postLikeCount" => $postLikeCount,
            "postLiked" => $postLiked,
            "post" => $post,
            "comments" => $comments,
            "subject" => $subject,
            "commentsLikeCount" => $commentsLikeCount,
            "commentsLikedByUser" => $commentsLikedByUser,
        );
        #return $data;
        return view("postsCtrl.view")->with($data);
    }

    public function checkSubjectPermission($subjectID){
        if(Auth::user()->type == 3) return 1;
        $subject = Subjects::where("id", $subjectID)->first();
        if($subject->open == 1) return 1;
        if($subject->user_id!=Auth::user()->id){
            return 0;
        }
        return 1;
    }

    public function checkPostPermission($postID){
        if(Auth::user()->type == 3) return 1;
        $postOwner = Posts::where("id", $postID)->first()->user_id;
        if($postOwner!=Auth::user()->id){
            return 0;
        }
        return 1;
    }

    public function checkUpvote($targetType, $targetID){
        $upvote = UpVotes::where("user_id", Auth::user()->id)
            ->where("target_type", $targetType)
            ->where("target_id", $targetID)
            ->first();
        if($upvote==null){
            return 0;
        } else {
            return 1;
        }
    }
}
