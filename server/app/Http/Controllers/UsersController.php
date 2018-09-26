<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\User;

class UsersController extends Controller
{
    public function finishRegisterSite(){
        return view("usersCtrl.finishRegister");
    }

    public function userViewingSite(){
        return 1;
    }

    public function userSettingNameChange(request $request){
        $request->validate([
            'user_name' => 'required|min:1',
        ]);
        $userID = Auth::user()->id;
        User::where("id", $userID)
            ->update([
                "name" => $request->user_name
            ]);
        return redirect('/user/view');
    }

    public function userSettingPasswordChange(request $request){
        $request->validate([
            'user_new_password' => 'required|min:6',
            'user_old_password' => 'required',
        ]);

        $userID = Auth::user()->id;
        $userHashedPassword = Hash::make($request->user_old_password);
        // Working on return error if oldPassword is wrong

        //
        User::where("id", $userID)
            ->update([
                "password" => Hash::make($request->user_new_password)
            ]);
        return redirect('/user/view');
    }

    public function userSettingImageChange(request $request){
        $request->validate([
            'file' => 'required|image',
        ]);
        $userID = Auth::user()->id;
        $userImage = Auth::user()->image;
        //Delete Cover Image
        if($userImage!="cover_default.png"){
            Storage::delete('public/file/'.$userImage);
        }

        if($request->hasFile('file')){
            // Filename to store
            $fileNameToStore = 'cover_'.time().'_'.$request->file('file')->getClientOriginalName();
            // Upload File
            $path = $request->file('file')->storeAs('public/file', $fileNameToStore);

            $user = User::where("id", $userID)
                ->update(["image" => $fileNameToStore]);
            return redirect('/user/view');
        } else {
            return redirect('/user/setting');
        }
    }
}
