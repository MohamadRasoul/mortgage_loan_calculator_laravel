<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition(): array
    {
        return [
            'loan_amount' => $this->faker->randomFloat(min: 100000,max: 1000_000),
            'loan_term' => $this->faker->numberBetween(1,50),
            'interest_rate' => $this->faker->randomFloat(min:  3,max: 5),
            'monthly_fixed_extra_payment' => $this->faker->randomFloat(min: 100,max: 1000),
            'loan_term_after_extra_repayment' => $this->faker->randomFloat(min: 1,max:50),
            'total_payment' => $this->faker->randomFloat(min: 1,max:50),
            'total_payment_after_extra_repayment' => $this->faker->randomFloat(min: 1,max:50),

            'user_id' => User::inRandomOrder()->first()->id,

        ];
    }
}
