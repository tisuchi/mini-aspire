<?php

namespace App\Http\Controllers;

use Response;
use App\Loan;
use Validator;
use Illuminate\Http\Request;

class LoanController extends Controller
{
	private $interestRate = 150;

	/**
	 * Return list of the loans
	 * @return [type] [description]
	 */
    public function index()
    {
    	return Response::json([	
			'status' => 'success',
            'users' => Loan::latest()->paginate(10)
		], 200); 
    }

    /**
     * Create a new loan
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
            'duration' => 'required',
            'original_amount' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse("Opps! Something went wrong.", 404);
        }

        Loan::create([
        	'user_id' => request('user_id'),
            'title' => request('title'),
            'duration' => request('duration'),
            'original_amount' => request('original_amount'),
            'interest_rate' => $this->interestRate,
            'total_amount' => ($this->interestRate * request('duration')) + request('original_amount')
        ]);

        return Response::json([	
			'status' => 'success',
            'loan' => "The Loan has created successfully."
		], 200); 
    }

    /**
     * Show a particular Loan
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
    	$loan = Loan::with('repayment')->find($id);

    	if ( ! $loan ) {
    		return $this->errorResponse("The loan hasn't found", 404);	
    	}

    	return Response::json([	
			'status' => 'success',
            'loan' => $loan
		], 200);
    }
}
