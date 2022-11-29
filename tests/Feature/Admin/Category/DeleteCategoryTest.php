<?php

namespace Tests\Feature\Admin\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;

    function loginAdmin()
    {
        User::factory()->create(
            [
                'email' => 'hello@example.com',
                'password' => Hash::make('123456'),
                'role' => '1',
            ]
        );
        $user = [
            'email' => 'hello@example.com',
            'password' => '123456',
        ];
        $this->post(route('loginPost'), $user);
    }

    public function test_delete_category()
    {
        $this->loginAdmin();


        $category = Category::factory()->create();

        $res = $this->delete(route('category.destroy', $category->id));

        $res->assertSessionHas('success');
    }
}
