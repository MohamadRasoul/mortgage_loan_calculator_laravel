<?php

namespace Tests\Feature;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoanTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }



    public function test_loans_screen_can_be_rendered(): void
    {
        $response = $this->actingAs($this->user)->get(route('loan.index'));

        $response->assertStatus(200);

    }
    public function test_new_calculator_screen_can_be_rendered(): void
    {
        $response = $this->actingAs($this->user)->get(route('loan.index'));

        $response->assertStatus(200);

    }
    public function test_calculate_new_loan_successful(): void
    {
        $loanData =  [
            'loan_amount' => 1_000_000,
            'loan_term' => 25,
            'interest_rate' => 6,
            'monthly_fixed_extra_payment' => 1_000,
        ];
        $response = $this
            ->actingAs($this->user)
            ->post(route('loan.calculator'),$loanData);


        $response->assertStatus(302);

        $this->assertDatabaseHas('loans',$loanData);

        $loan = Loan::latest()->first();

        $response->assertRedirect(route('loan.show',$loan->id));
    }

    public function test_calculate_new_loan_without_extra_repayment_successful(): void
    {
        $loanData =  [
            'loan_amount' => 1_000_000,
            'loan_term' => 25,
            'interest_rate' => 6,
        ];
        $response = $this
            ->actingAs($this->user)
            ->post(route('loan.calculator'),$loanData);


        $response->assertStatus(302);

        $this->assertDatabaseHas('loans',$loanData);

        $loan = Loan::latest()->first();

        $response->assertRedirect(route('loan.show',$loan->id));
    }

    public function test_show_loan_calculator_contains_correct_value_successful(): void
    {
        $loanData =  [
            'loan_amount' => 1_000_000,
            'loan_term' => 25,
            'interest_rate' => 6,
            'monthly_fixed_extra_payment' => 1_000,
        ];
        $this
            ->actingAs($this->user)
            ->post(route('loan.calculator'),$loanData);

        $loan = Loan::latest()->first();
        $response = $this->actingAs($this->user)->get(route('loan.show',$loan->id));
        $response->assertViewHas('loan',$loan);
        $response->assertSeeText(round($loan->total_payment));
        $response->assertSeeText(round($loan->total_payment_after_extra_repayment));
        $response->assertStatus(200);
    }


    public function test_calculate_new_loan_validation_error_redirects_to_form(): void
    {
        $loanData =  [
            'loan_amount' => 100,
            'loan_term' => 60,
            'interest_rate' => 6,
            'monthly_fixed_extra_payment' => 1_000,
        ];
        $response = $this
            ->actingAs($this->user)
            ->post(route('loan.calculator'),$loanData);


        $response->assertStatus(302);
        $response->assertInvalid(['loan_amount','loan_term']);
    }


    public function test_calculate_new_loan_validation_error_if_extra_large_than_amount(): void
    {
        $loanData =  [
            'loan_amount' => 1_000_000,
            'loan_term' => 25,
            'interest_rate' => 5,
            'monthly_fixed_extra_payment' => 10_000_000,
        ];
        $response = $this
            ->actingAs($this->user)
            ->post(route('loan.calculator'),$loanData);


        $response->assertStatus(302);
        $response->assertInvalid(['monthly_fixed_extra_payment']);
    }


    public function test_guest_cannot_access_loans_pages(): void
    {
        $response = $this->get(route('loan.index'));

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }


//    test_can_add_loan_to_calculate_



}
