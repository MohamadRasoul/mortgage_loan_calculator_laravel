<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraRepaymentSchedule extends Model
{
    use HasFactory;


    protected $fillable = [
        'month_number',
        'starting_balance',
        'monthly_payment',
        'principal_component',
        'interest_component',
        'ending_balance',
        'loan_id'
    ];



    protected function startingBalance(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => round($value, 2),
        );
    }

    protected function monthlyPayment(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => round($value, 2),
        );
    }

    protected function principalComponent(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => round($value, 2),
        );
    }

    protected function interestComponent(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => round($value, 2),
        );
    }
    protected function endingBalance(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => round($value, 2),
        );
    }




}
