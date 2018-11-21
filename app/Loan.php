<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
    	'user_id',
	    'title',
	    'description',
	    'duration',
	    'original_amount',
	    'interest_rate',
	    'total_amount'
    ];

    /**
     * A loan has many repayment
     * @return [type] [description]
     */
    public function repayment()
    {
    	return $this->hasMany('App\Repayment', 'loan_id', 'id');
    }

}
