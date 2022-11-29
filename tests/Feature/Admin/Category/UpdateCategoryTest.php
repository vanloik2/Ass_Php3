<?php

namespace Tests\Feature\Admin\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
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

    public function test_screen_uppdate_category()
    {
        $this->loginAdmin();

        $category = Category::factory()->create();

        $res = $this->get(route('category.edit', $category->id));

        $res->assertViewHas('title');
    }

    public function test_validate_name_null_when_update_category()
    {
        $this->loginAdmin();
        $category = Category::factory()->create();

        $res = $this->put(route('category.update', $category->id), [
            'name' => '',
            'image' => $category->image,
        ]);

        $res->assertSessionHasErrors('name');
    }

    public function test_update_category_successfully()
    {
        $this->loginAdmin();
        $cate = Category::factory()->make();
        $category = Category::factory()->create();

        $res = $this->put(route('category.update', $category->id), [
            'name' => $cate->name,
            'image' => $category->image,
        ]);

        $res->assertSessionHas('success')
            ->assertRedirect(route('category.index'));
    }
}
