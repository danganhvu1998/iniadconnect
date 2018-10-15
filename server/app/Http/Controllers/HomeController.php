<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Subjects;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $teamMembers = User::where("id", ">", 1)
            ->where("id", "<", 8)
            ->get();
        $teamImage = Subjects::where("id", 2)->first()->cover_image;
        $data = array(
            "teamMembers" =>  $teamMembers,
            "teamImage" => $teamImage
        );
        return view('home')->with($data);
    }
}
