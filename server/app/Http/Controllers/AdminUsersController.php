<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

class AdminUsersController extends Controller
{   
    public function __construct()
    {
        $this->middleware(['auth', 'checkAdmin']);
    }

    public function usersViewSite($userType){
        $users = User::where("type", $userType)->get();
        return view("adminUsersCtrl.view")->with("users", $users);
    }

    public function resetUserPassword($userID){
        $newPass = Hash::make(((string)rand(0, 1000000000))."iniadconnect");
        User::where("id", $userID)
            ->update([
                "password" => Hash::make($newPass),
                "remember_token" => $newPass
            ]);
        return back()->withErrors($newPass);
    }

    public function changeTypeUser($type, $userID){
        if($type>2) { return "LOL, How could you?";}
        User::where("id", $userID)
        ->update([
            "type" => $type,
        ]);
        return back()->with("message", "messages.success");
    }
}
