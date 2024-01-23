<?php

namespace Feature\QA;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_login_without_remember_me()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_requires_email_and_password()
    {
        $response = $this->post(route('login'), [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('password');
    }

    // test wrong credentials
    public function test_wrong_credentials()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertEquals(session('errors')->get('email')[0], 'These credentials do not match our records.');
    }

    public function test_successful_registration()
    {
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);

        $this->assertAuthenticated();
    }

    public function test_registration_requires_name_email_and_password()
    {
        $response = $this->post(route('register'), [
            'name' => '',
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('password');
    }
}