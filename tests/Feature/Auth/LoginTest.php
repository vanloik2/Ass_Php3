<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_screen_user_login()
    {
        $data = $this->get('/login');

        $data->assertStatus(Response::HTTP_OK);
    }

    public function test_user_login_feature_without_an_account()
    {
        $users = [
            'email' => 'test@example.com',
            'password' => '123456',
        ];
        $res = $this->post(route('loginPost'), $users);

        $res->assertStatus(302)
            ->assertSessionHasAll(['error']);
    }

    public function test_user_login_feature_when_email_empty()
    {
        $users = [
            'email' => null,
            'password' => '123456',
        ];
        $res = $this->post(route('loginPost'), $users);

        $res->assertStatus(302)
            ->assertSessionHasErrors('email');
    }

    public function test_user_login_feature_when_pass_empty()
    {
        $users = [
            'email' => 'example@example.com',
            'password' => '',
        ];

        $res = $this->post(route('loginPost'), $users);

        $res->assertStatus(302)
            ->assertSessionHasErrors('password');
    }

    //Success
    public function test_user_login_feature_have_an_account()
    {
        User::factory()->create(
            [
                'email' => 'hello@example.com',
                'password' => Hash::make('123456'),
                'role' => '2',
            ]
        );

        $users = [
            'email' => 'hello@example.com',
            'password' => '123456',
        ];

        $res = $this->post(route('loginPost'), $users);
        $res->assertRedirect(route('user.index'));
    }
}
