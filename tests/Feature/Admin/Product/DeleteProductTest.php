<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DeleteProductTest extends TestCase
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

    public function test_feature_delete_product()
    {
        $this->loginAdmin();

        $product = Product::factory()->create();

        $res = $this->delete(route('product.destroy', $product->id));

        $res->assertSessionHasAll(['success']);
    }
}
