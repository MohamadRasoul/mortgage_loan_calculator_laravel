<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\LoanAmortizationSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LoanAmortizationScheduleFactory extends Factory
{
    protected $model = LoanAmortizationSchedule::class;

    public function definition(): array
    {
        return [
            'month_number' => $this->faker->numberBetween(1,12),
            'starting_balance' => $this->faker->randomFloat(min: 10000,max:100000),
            'monthly_payment' => $this->faker->randomFloat(min: 10000,max:100000),
            'principal_component' => $this->faker->randomFloat(min: 10000,max:100000),
            'interest_component' => $this->faker->randomFloat(min: 10000,max:100000),
            'ending_balance' => $this->faker->randomFloat(min: 100000,max:1000000),

            'loan_id' => Loan::inRandomOrder()->first()->id,
        ];
    }
}
