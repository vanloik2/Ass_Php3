<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateProductTest extends TestCase
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

    public function test_screen_create_product()
    {
        $this->loginAdmin();

        $res = $this->get(route('product.create'));

        $res->assertStatus(Response::HTTP_OK)
            ->assertViewHasAll(['title']);
    }

    public function test_validate_fillable_create_product()
    {

        $this->loginAdmin();

        $res = $this->post(
            route('product.store'),
            [
                'name' => '',
                'price' => '',
                'quantity' => '',
                'category_id' => '',
                'image' => '',
            ]
        );

        $res->assertSessionHasErrors([
            'name',
            'price',
            'quantity',
            'category_id',
            'image',
        ]);
    }

    public function test_create_product_successfully()
    {

        $this->loginAdmin();

        $product = Product::factory()->make();

        $res = $this->post(
            route('product.store'),
            [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'category_id' => $product->category_id,
                'image' => $product->image,
                'description' => $product->description,
                'status' => $product->status,
            ]
        );

        $res->assertRedirect(route('product.index'))
            ->assertSessionHasAll(['success']);
    }
}
