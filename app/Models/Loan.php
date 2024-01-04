<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory;


    protected $fillable = [
        'loan_amount',
        'loan_term',
        'interest_rate',
        'Monthly_fixed_extra_payment',
        'remaining_loan_term_after_extra_repayment',
        'user_id',
    ];


    public function extraRepaymentSchedules(): HasMany
    {
        return $this->hasMany(ExtraRepaymentSchedule::class, 'loan_id');
    }


    public function loanAmortizationSchedules(): HasMany
    {
        return $this->hasMany(LoanAmortizationSchedule::class, 'loan_id');
    }

}
