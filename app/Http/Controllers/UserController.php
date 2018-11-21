<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
    	return Response::json([	
			'status' => 'success',
            'users' => User::latest()->paginate(10)
		], 200); 
    }
}
