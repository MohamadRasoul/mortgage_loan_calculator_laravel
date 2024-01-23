<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoansTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_loan_create()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                ->type('email', 'test@test.com')
                ->type('password', '12345678')
                ->press('#login')
                ->assertPathIs('/loan')
                ->clickLink('New Loan Clac')
                ->assertPathIs('/loan/calculator')
                ->type('loan_amount', '100000')
                ->type('interest_rate', '3')
                ->type('loan_term', '5')
                ->press('#save')
                ->assertSee('Mortgage Loan Calculator')
                ->assertSee('Total Monthly Payments:')
                ->assertSee('107812.14');
        });
    }

    /** @test */
    public function test_loan_creation_with_extra_payment()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                ->type('email', 'test@test.com')
                ->type('password', '12345678')
                ->press('#login')
                ->assertPathIs('/loan')
                ->clickLink('New Loan Clac')
                ->assertPathIs('/loan/calculator')
                ->type('loan_amount', '100000')
                ->type('interest_rate', '3')
                ->type('loan_term', '5')
                ->type('monthly_fixed_extra_payment', '10')
                ->press('#save')
                ->assertSee('Mortgage Loan Calculator')
                ->assertSee('Total Monthly Payments:')
                ->assertSee('107812.14')
                ->assertSee('108412.14');
        });
    }
}