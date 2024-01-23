<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_view_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Login')
                ->assertInputPresent('email')
                ->assertInputPresent('password');
        });
    }

    // test success login
    public function test_success_login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                ->type('email', 'test@test.com')
                ->type('password', '12345678')
                ->press('#login')
                ->assertPathIs('/loan');
        });
    }

    // test wrong password
    public function test_wrong_password()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                ->type('email', 'user@example.com')
                ->type('password', '123456789')
                ->press('#login')
                ->assertSee('These credentials do not match our records.');
        });
    }

    // test success register
    public function test_success_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('register'))
                ->type('name', 'test')
                ->type('email', 'user@example.com')
                ->type('password', '12345678')
                ->type('password_confirmation', '12345678')
                ->press('#register')
                ->assertPathIs('/loan');
        });
    }
}