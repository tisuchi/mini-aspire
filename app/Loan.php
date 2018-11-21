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

}
