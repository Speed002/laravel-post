<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
    //Login       
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]); 

        if(!auth()->attempt($request->only('email', 'password'))){
            return back()->with('status', 'Invalid Credentials');
        }
        return redirect()->route('dashboard');
    }
}