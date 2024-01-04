<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;


    protected $fillable = [
        'loan_amount',
        'loan_term',
        'interest_rate',
        'Monthly_fixed_extra_payment'
    ];


}
