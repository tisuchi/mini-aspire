<?php

namespace App;

use App\Loan;
use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    protected $fillable = [
    	'loan_id',
    	'user_id',
    	'amount',
    ];

    /**
     * A repayment is belongs to a Loan
     * @return [type] [description]
     */
    public function loan()
    {
    	return $this->belongsTo('App\Loan', 'loan_id', 'id');
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
     * Get total payment amount for any particular loan
     * @param  [type] $loanId [description]
     * @return [type]         [description]
     */
    public function payableAmount($loanId)
    {
    	$loan = Loan::find($loanId);

		$payableAmount = round($loan->total_amount / $loan->duration);	
    	$maxiumPayableAmount = (new Repayment)->repaymentUpTo($loanId);

    	if ( $maxiumPayableAmount > $payableAmount ) {
    		return $payableAmount;
    	}

    	return $maxiumPayableAmount;
    }

}
