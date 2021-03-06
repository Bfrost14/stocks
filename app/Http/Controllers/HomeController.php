<?php

namespace App\Http\Controllers;

use App\Models\Sortie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $email = Auth::user()->email;
        $sorties = Sortie::where("email_users",$email)->count();
        $users = Auth::user();
        return view('home',compact("email","sorties","users"));
    }
}
