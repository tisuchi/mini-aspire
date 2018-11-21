<?php

namespace App;

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

    public function scopeTotalRepayment($query, $loanId)
    {
        return $query->where('loan_id', $loanId);
    }

    public function scopeRepaymentLeft($query, $loanId)
    {
    	return $this->where('loan_id', $loanId)->with('loan');
    }



}
