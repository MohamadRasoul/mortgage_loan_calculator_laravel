<?php

namespace Feature\QA;

use App\Models\Loan;
use App\Models\User;
use App\RepaymentSchedule\RepaymentScheduleDirector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_listing_loans()
    {
        $user = User::factory()->create();
        $loans = Loan::factory(2)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('loan.index'));

        $response->assertStatus(200);

        foreach ($loans as $loan) {
            $response->assertSee($loan->loan_amount);
            $response->assertSee($loan->interest_rate);
            $response->assertSee($loan->loan_term);
        }
    }

    public function test_user_can_view_create_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('loan.calculator'));

        $response->assertStatus(200);
        $response->assertSee('Calculator');
    }

    public function test_user_can_view_loan_details()
    {
        $user = User::factory()->create();
        $loan = Loan::factory()->create(['user_id' => $user->id]);
        RepaymentScheduleDirector::handle($loan);

        $response = $this->actingAs($user)->get(route('loan.show', $loan));

        $response->assertStatus(200);
        $response->assertSee($loan->loan_amount);
        $response->assertSee($loan->interest_rate);
        $response->assertSee($loan->loan_term);
    }

    // loan amount, loan term, interest rate are required
    public function test_loan_amount_loan_term_interest_rate_are_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('loan.calculator'), [
            'loan_amount' => '',
            'loan_term' => '',
            'interest_rate' => '',
        ]);

        $response->assertSessionHasErrors(['loan_amount', 'loan_term', 'interest_rate']);
    }

    public function test_loan_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('loan.calculator'), [
            'loan_amount' => 100000,
            'loan_term' => 5,
            'interest_rate' => 3,
        ]);

        $loan = Loan::first();

        $response->assertRedirect(route('loan.show', $loan->id));

        $this->assertDatabaseHas('loans', [
            'loan_amount' => 100000,
            'loan_term' => 5,
            'interest_rate' => 3,
        ]);

        $this->assertEquals($loan->loan_term_by_month, 60);
        $this->assertEquals($loan->monthly_interest_rate, 0.0025);
        $this->assertEquals(number_format($loan->total_payment, 2), '107,812.14');
        $this->assertCount(60, $loan->loanAmortizationSchedules);

        // test first 3 rows
        $this->assertEquals($loan->loanAmortizationSchedules[0]->month_number, 1);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->principal_component, 1546.87);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->interest_component, 250);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->ending_balance, 98453.13);

        $this->assertEquals($loan->loanAmortizationSchedules[1]->month_number, 2);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->principal_component, 1550.74);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->interest_component, 246.13);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->ending_balance, 96902.39);

        $this->assertEquals($loan->loanAmortizationSchedules[2]->month_number, 3);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->principal_component, 1554.61);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->interest_component, 242.26);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->ending_balance, 95347.78);

        // test last 3 rows
        $this->assertEquals($loan->loanAmortizationSchedules[57]->month_number, 58);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->principal_component, 1783.46);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->interest_component, 13.41);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->ending_balance, 3580.31);

        $this->assertEquals($loan->loanAmortizationSchedules[58]->month_number, 59);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->principal_component, 1787.92);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->interest_component, 8.95);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->ending_balance, 1792.39);

        $this->assertEquals($loan->loanAmortizationSchedules[59]->month_number, 60);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->principal_component, 1792.39);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->interest_component, 4.48);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->ending_balance, 0);
    }

    // test loan creation with fixed extra payment
    public function test_loan_can_be_created_with_fixed_extra_payment()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('loan.calculator'), [
            'loan_amount' => 100000,
            'loan_term' => 5,
            'interest_rate' => 3,
            'monthly_fixed_extra_payment' => 10,
        ]);

        $loan = Loan::first();

        $response->assertRedirect(route('loan.show', $loan->id));

        $this->assertDatabaseHas('loans', [
            'loan_amount' => 100000,
            'loan_term' => 5,
            'interest_rate' => 3,
        ]);

        $this->assertEquals($loan->loan_term_by_month, 60);
        $this->assertEquals($loan->monthly_interest_rate, 0.0025);
        $this->assertEquals(number_format($loan->total_payment, 2), '107,812.14');
        $this->assertCount(60, $loan->loanAmortizationSchedules);
        $this->assertCount(60, $loan->extraRepaymentSchedules);

        // test first 3 rows in loan amortization schedule
        $this->assertEquals($loan->loanAmortizationSchedules[0]->month_number, 1);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->principal_component, 1546.87);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->interest_component, 250);
        $this->assertEquals($loan->loanAmortizationSchedules[0]->ending_balance, 98453.13);

        $this->assertEquals($loan->loanAmortizationSchedules[1]->month_number, 2);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->principal_component, 1550.74);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->interest_component, 246.13);
        $this->assertEquals($loan->loanAmortizationSchedules[1]->ending_balance, 96902.39);

        $this->assertEquals($loan->loanAmortizationSchedules[2]->month_number, 3);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->principal_component, 1554.61);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->interest_component, 242.26);
        $this->assertEquals($loan->loanAmortizationSchedules[2]->ending_balance, 95347.78);

        // test last 3 rows in loan amortization schedule
        $this->assertEquals($loan->loanAmortizationSchedules[57]->month_number, 58);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->principal_component, 1783.46);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->interest_component, 13.41);
        $this->assertEquals($loan->loanAmortizationSchedules[57]->ending_balance, 3580.31);

        $this->assertEquals($loan->loanAmortizationSchedules[58]->month_number, 59);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->principal_component, 1787.92);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->interest_component, 8.95);
        $this->assertEquals($loan->loanAmortizationSchedules[58]->ending_balance, 1792.39);

        $this->assertEquals($loan->loanAmortizationSchedules[59]->month_number, 60);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->starting_balance, 100000);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->monthly_payment, 1796.87);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->principal_component, 1792.39);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->interest_component, 4.48);
        $this->assertEquals($loan->loanAmortizationSchedules[59]->ending_balance, 0);

        // test first 3 rows in extra repayment schedule
        $this->assertEquals($loan->extraRepaymentSchedules[0]->month_number, 1);
        $this->assertEquals($loan->extraRepaymentSchedules[0]->starting_balance, 100000);
        $this->assertEquals($loan->extraRepaymentSchedules[0]->monthly_payment, 1806.87);
        $this->assertEquals($loan->extraRepaymentSchedules[0]->principal_component, 1556.87);
        $this->assertEquals($loan->extraRepaymentSchedules[0]->interest_component, 250);
        $this->assertEquals($loan->extraRepaymentSchedules[0]->ending_balance, 98443.13);

        $this->assertEquals($loan->extraRepaymentSchedules[1]->month_number, 2);
        $this->assertEquals($loan->extraRepaymentSchedules[1]->starting_balance, 100000);
        $this->assertEquals($loan->extraRepaymentSchedules[1]->monthly_payment, 1806.87);
        $this->assertEquals($loan->extraRepaymentSchedules[1]->principal_component, 1560.76);
        $this->assertEquals($loan->extraRepaymentSchedules[1]->interest_component, 246.11);
        $this->assertEquals($loan->extraRepaymentSchedules[1]->ending_balance, 96882.37);

        $this->assertEquals($loan->extraRepaymentSchedules[2]->month_number, 3);
        $this->assertEquals($loan->extraRepaymentSchedules[2]->starting_balance, 100000);
        $this->assertEquals($loan->extraRepaymentSchedules[2]->monthly_payment, 1806.87);
        $this->assertEquals($loan->extraRepaymentSchedules[2]->principal_component, 1564.66);
        $this->assertEquals($loan->extraRepaymentSchedules[2]->interest_component, 242.21);
        $this->assertEquals($loan->extraRepaymentSchedules[2]->ending_balance, 95317.71);

        // test last 3 rows in extra repayment schedule
        $this->assertEquals($loan->extraRepaymentSchedules[57]->month_number, 58);
        $this->assertEquals($loan->extraRepaymentSchedules[57]->starting_balance, 100000);
        $this->assertEquals($loan->extraRepaymentSchedules[57]->monthly_payment, 1806.87);
        $this->assertEquals($loan->extraRepaymentSchedules[57]->principal_component, 1794.99);
        $this->assertEquals($loan->extraRepaymentSchedules[57]->interest_component, 11.88);
        $this->assertEquals($loan->extraRepaymentSchedules[57]->ending_balance, 2956.98);

        $this->assertEquals($loan->extraRepaymentSchedules[58]->month_number, 59);
        $this->assertEquals($loan->extraRepaymentSchedules[58]->starting_balance, 100000);
        $this->assertEquals($loan->extraRepaymentSchedules[58]->monthly_payment, 1806.87);
        $this->assertEquals($loan->extraRepaymentSchedules[58]->principal_component, 1799.48);
        $this->assertEquals($loan->extraRepaymentSchedules[58]->interest_component, 7.39);
        $this->assertEquals($loan->extraRepaymentSchedules[58]->ending_balance, 1157.51);

        $this->assertEquals($loan->extraRepaymentSchedules[59]->month_number, 60);
        $this->assertEquals($loan->extraRepaymentSchedules[59]->starting_balance, 100000);
        $this->assertEquals($loan->extraRepaymentSchedules[59]->monthly_payment, 1806.87);
        $this->assertEquals($loan->extraRepaymentSchedules[59]->principal_component, 1803.98);
        $this->assertEquals($loan->extraRepaymentSchedules[59]->interest_component, 2.89);
        $this->assertEquals($loan->extraRepaymentSchedules[59]->ending_balance, 0);
    }
}