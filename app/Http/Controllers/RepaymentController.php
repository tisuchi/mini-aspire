<?php

namespace App\Http\Controllers;

use App\Loan;
use Response;
use Validator;
use App\Repayment;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    public function show($id)
    {
    	return Repayment::with('loan')->find($id);
    }

    /**
     * Store a repayment for a loan
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'loan_id' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse("Opps! Something went wrong.", 404);
        }

        // check whether the amount is minimum payable or not
        $totalPayableAmount = $this->payableAmount(request('loan_id'));

        if ( $totalPayableAmount > request('amount')) {
        	return $this->errorResponse("Opps! Minimum payable amount for this loan is " . $totalPayableAmount, 404);
        }

        // check how much can be repayable
        $maximuPayableAmount = $this->repaymentUpTo(request('loan_id'));

        if ( request('amount') > $maximuPayableAmount ) {
        	return $this->errorResponse("Opps! It will be repaid if you pay " . $maximuPayableAmount . " more for this loan.", 404);
        }

    	$loan = Loan::withCount('repayment')->find(request('loan_id'));

    	if ( $loan->repayment_count >= $loan->duration ) {
    		return $this->errorResponse("Opps! The repayment already been repaid.", 404);
    	}

    	Repayment::create([
    		'loan_id' => request('loan_id'),
    		'user_id' => request('user_id'),
    		'amount' => request('amount'),
    	]);
    	
    	return Response::json([	
			'status' => 'success',
            'repayment' => "The repayment has been done successfully."
		], 200); 
    }

    /**
     * Get total payment amount for any particular loan
     * @param  [type] $loanId [description]
     * @return [type]         [description]
     */
    public function payableAmount($loanId)
    {
    	$loan = Loan::find($loanId);

		$payableAmount = round($loan->total_amount / $loan->duration);	
    	$maxiumPayableAmount = $this->repaymentUpTo($loanId);

    	if ( $maxiumPayableAmount > $payableAmount ) {
    		return $payableAmount;
    	}

    	return $maxiumPayableAmount;
    }

    /**
     * Check whether this loan can still repaymentable or not
     * @param  [type] $loanId [description]
     * @return [type]         [description]
     */
    public function canRepayment($loanId)
    {
    	$loan = Loan::with('repayment')->find($loanId);

    	return $loan->total_amount > $loan->repayment->sum('amount');
    }

    /**
     * Check how much maximun can be repayable
     * @param  [type] $loanId [description]
     * @return [type]         [description]
     */
    public function repaymentUpTo($loanId)
    {
    	$loan = Loan::with('repayment')->find($loanId);

    	return $loan->total_amount - $loan->repayment->sum('amount');	
    }
}
