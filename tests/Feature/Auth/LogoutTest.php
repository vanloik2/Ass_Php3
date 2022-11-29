<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    function loginAdmin()
    {
        User::factory()->create(
            [
                'email' => 'hello@example.com',
                'password' => Hash::make('123456'),
                'role' => '2',
            ]
        );
        $user = [
            'email' => 'hello@example.com',
            'password' => '123456',
        ];
        $this->post(route('loginPost'), $user);
    }

    public function test_logout_user()
    {
        $this->loginAdmin();
        $res = $this->get('logout');

        $res->assertRedirect('/login')
            ->assertSessionHas('success');
    }
}
