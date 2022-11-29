<?php

namespace Tests\Feature\Admin\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{

    use RefreshDatabase;

    function loginAdmin($role)
    {
        User::factory()->create(
            [
                'email' => 'hello@example.com',
                'password' => Hash::make('123456'),
                'role' => $role,
            ]
        );
        $user = [
            'email' => 'hello@example.com',
            'password' => '123456',
        ];
        $this->post(route('loginPost'), $user);
    }

    public function test_screen_create_category()
    {
        $this->loginAdmin(1);

        $res = $this->get(route('category.create'));

        $res->assertViewHasAll(['title']);
    }

    public function test_validate_name_null_when_create_category()
    {
        $this->loginAdmin(1);

        $category = Category::factory()->make();

        $res = $this->post(route('category.store'), [
            'name' => '',
            'image' => $category->image,
        ]);

        $res->assertSessionHasErrors('name');
    }

    public function test_validate_name_unique_when_create_category()
    {
        $this->loginAdmin(1);

        Category::factory()->create([
            'name' => 'Test Category Unique',
        ]);
        $category = Category::factory()->make();

        $res = $this->post(route('category.store'), [
            'name' => 'Test Category Unique',
            'image' => $category->image,
        ]);

        $res->assertSessionHasErrors('name');
    }

    public function test_create_category_successfully()
    {
        $this->loginAdmin(1);

        $category = Category::factory()->make();

        $res = $this->post(route('category.store'), [
            'name' => $category->name,
            'image' => $category->image,
        ]);

        $res->assertRedirect(route('category.index'))
            ->assertSessionHas('success');
    }
}
