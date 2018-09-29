<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comments;

class CommentsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function commentAdding(request $request){
        $request->validate([
            'postID' => 'required',
            'commentContent' => 'required',
        ]);
        $comment = new Comments;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->commentContent;
        $comment->post_id = $request->postID;
        $comment->save();
        return back();
    }

    public function commentDeletingSite($commentID){
        if(!$this->checkCommentPermission($commentID)){
            return back()->withErrors("Permission Denied");
        }
        Comments::where("id", $commentID)->delete();
        return back()->with("message", "messages.success");
        return 0;
    }

    public function checkCommentPermission($commentID){
        if(Auth::user()->type == 3) return 1;
        $commentOwner = Posts::where("id", $commentID)->first()->user_id;
        if($postOwner!=Auth::user()->id){
            return 0;
        }
        return 1;
    }
}
