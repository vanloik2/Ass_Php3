<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateProductTest extends TestCase
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

    public function test_screen_update_product()
    {
        $this->loginAdmin();

        $product = Product::factory()->create();

        $res = $this->get(route('product.edit', $product->id));

        $res->assertStatus(Response::HTTP_OK);
    }

    public function test_feature_update_still_keep_old_data()
    {
        $this->loginAdmin();

        $product = Product::factory()->create();

        $res = $this->put(route('product.update', $product->id), [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'category_id' => $product->category_id,
            'image' => $product->image,
            'description' => $product->description,
            'status' => $product->status
        ]);
        // assertRedirect(route('product.index'))
        $res->assertStatus(302)
            ->assertRedirect(route('product.index'))
            ->assertSessionHasAll(['success']);
    }

    public function test_validate_fillable_product_when_update()
    {
        $this->loginAdmin();

        $product = Product::factory()->create();

        $res = $this->put(route('product.update', $product->id), [
            'name' => '',
            'price' => '',
            'quantity' => '',
            'category_id' => '',
            'image' => $product->image,
            'description' => $product->description,
            'status' => $product->status
        ]);

        $res->assertSessionHasErrors([
            'name',
            'price',
            'quantity',
            'category_id',
        ]);
    }

    public function test_feature_update_new_data()
    {
        $this->loginAdmin();

        $product = Product::factory()->create();
        $proUp = Product::factory()->make();
        $res = $this->put(route('product.update', $product->id), [
            'name' => $proUp->name,
            'price' => $product->price,
            'quantity' => $proUp->quantity,
            'category_id' => $product->category_id,
            'image' => $proUp->image,
            'description' => $product->description,
            'status' => $proUp->status
        ]);
        // assertRedirect(route('product.index'))
        $res->assertStatus(302)
            ->assertRedirect(route('product.index'))
            ->assertSessionHasAll(['success']);
    }
}
