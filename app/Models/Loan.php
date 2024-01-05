<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory;


    protected $fillable = [
        'loan_amount',
        'loan_term',
        'interest_rate',
        'monthly_fixed_extra_payment',
        'loan_term_after_extra_repayment',
        'total_payment',
        'total_payment_after_extra_repayment',
        'user_id',
    ];


    protected $casts = [
        'loan_amount'=>'float',
    ];


    protected function loanTermByMonth(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => ceil($attributes['loan_term'] * 12),
        );
    }
    protected function monthlyInterestRate(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => (($attributes['interest_rate'] / 12 ) / 100),
        );
    }


    public function extraRepaymentSchedules(): HasMany
    {
        return $this->hasMany(ExtraRepaymentSchedule::class, 'loan_id');
    }


    public function loanAmortizationSchedules(): HasMany
    {
        return $this->hasMany(LoanAmortizationSchedule::class, 'loan_id');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
