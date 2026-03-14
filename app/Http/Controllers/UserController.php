<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function Dashboard(){
        if(Auth::check()&&Auth::user()->user_type=='user')
          
            {
             return view("index");  
            }
        else if(Auth::check()&&Auth::user()->user_type=='admin')
            {
             return view("admin.dashboard");  
            }
        else{
            return redirect('/');
        }

       
    }
    public function Index()
    {
        return view('index');
    }
}
