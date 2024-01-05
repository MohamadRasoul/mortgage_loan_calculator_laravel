<?php

namespace Database\Seeders;

use App\Models\ExtraRepaymentSchedule;
use App\Models\Loan;
use App\Models\LoanAmortizationSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Loan::factory()
            ->count(3)
            ->has(
                LoanAmortizationSchedule::factory()
                    ->count(50)
                    ->sequence(fn(Sequence $sequence) => ['month_number' => (($sequence->index) % 12) + 1])
            )
            ->has(
                ExtraRepaymentSchedule::factory()
                    ->count(50)
                    ->sequence(fn(Sequence $sequence) => ['month_number' => (($sequence->index) % 12) + 1])
            )
            ->create();
    }
}
