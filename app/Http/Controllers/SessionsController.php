<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest')->except('destroy');
	}

    public function create()
    {
    	return view('sessions.create');

   
    }

    public function store()
    {
    	//Authenticate the user and sign in if exists
    	if(! auth()->attempt(request(['email', 'password'])))
    	{
    		return back()->withErrors([

    			'message' => 'Please check your credentials and try again'

    		]);
    	}

    	return redirect()->home();
    }

    public function destroy()
    {
    	auth()->logout();

        session()->flash('message', 'You has been succesfully logout.');

    	return redirect()->home();
    }


}
