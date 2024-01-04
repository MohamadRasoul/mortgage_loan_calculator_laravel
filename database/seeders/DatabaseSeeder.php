<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ExtraRepaymentSchedule;
use App\Models\Loan;
use App\Models\LoanAmortizationSchedule;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => '12345678',
        ]);


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
