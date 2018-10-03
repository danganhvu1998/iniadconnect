<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\UpVotes;

class UpVotesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function upvote($targetType, $targetID){
        $upvote = UpVotes::where("user_id", Auth::user()->id)
            ->where("target_type", $targetType)
            ->where("target_id", $targetID)
            ->first();
        if($upvote==null){
            $this->addUpvote($targetType, $targetID);
        } else {
            $this->deleteUpvote($targetType, $targetID);
        }
        return back();
    }

    public function deleteUpvote($targetType, $targetID){
        UpVotes::where("user_id", Auth::user()->id)
            ->where("target_type", $targetType)
            ->where("target_id", $targetID)
            ->delete();
    }

    public function addUpvote($targetType, $targetID){
        $upvote = new UpVotes;
        $upvote->user_id = Auth::user()->id;
        $upvote->target_type = $targetType;
        $upvote->target_id = $targetID;
        $upvote->save();
    }
}
