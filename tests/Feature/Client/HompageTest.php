<?php

namespace Tests\Feature\Client;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HompageTest extends TestCase
{
    use RefreshDatabase;

    public function test_data_show_homepage()
    {
        $res = $this->get(route('home_page'));

        $res->assertViewHas(['products', 'productss']);
    }

    public function test_show_data_products()
    {
        $res = $this->get(route('products'));

        $res->assertViewHas(['categories', 'products']);
    }

    // public function test_show_product_detail()
    // {
    //     $product = Product::factory()->create();

    //     $res = $this->get(route('product-detail', $product->id));

    //     $res->assertViewHasAll(['product', 'productCate', 'comments']);
    // }
}
