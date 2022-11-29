<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegiterTest extends TestCase
{
    use RefreshDatabase;

    public function test_screen_user_register()
    {
        $response = $this->get('/register');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_validate_pass_lenght()
    {
        $user = User::factory()->make();

        $res = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => '12345',
            'password_confirmation' => '12345',
        ]);

        $res->assertSessionHasErrors('password');
    }

    public function test_validate_pass_confirmed()
    {
        $user = User::factory()->make();

        $res = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => '12345',
            'password_confirmation' => '123456',
        ]);

        $res->assertSessionHasErrors('password');
    }

    public function test_validate_name_and_email_null()
    {
        $res = $this->post('/register', [
            'name' => '',
            'email' => '',
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);

        $res->assertSessionHasErrors('name', 'email');
    }

    public function test_user_registed_successfully()
    {
        $user = User::factory()->make();

        $res = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);

        $res->assertRedirect(route('login'))
            ->assertSessionHas('success');
    }
}
