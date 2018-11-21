<?php

namespace App\Http\Controllers;

use Response;
use App\User;
use Validator;
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

    /**
     * Show a particular User
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function show($id)
    {
        $user = User::with('loan')->find($id);

        if ( ! $user ) {
            return $this->errorResponse("The user hasn't found", 404);  
        }

    	return Response::json([	
			'status' => 'success',
            'user' => $user
		], 200); 
    }

    /**
     * Store a user data
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse("Opps! Something went wrong.", 404);
        }

        User::create([
        	'name' => request('name'),
        	'email' => request('email'),
        	'password' => bcrypt(request('name'))
        ]);

        return Response::json([	
			'status' => 'success',
            'user' => "The user has created successfully."
		], 200); 
    }
}
