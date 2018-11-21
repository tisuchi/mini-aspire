<?php

namespace App\Http\Controllers;

use Response;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * Return list of the users
	 * @return [type] [description]
	 */
    public function index()
    {
    	return Response::json([	
			'status' => 'success',
            'users' => User::latest()->paginate(10)
		], 200); 
    }

    public function show(User $user)
    {
    	return Response::json([	
			'status' => 'success',
            'user' => $user
		], 200); 
    }
}
