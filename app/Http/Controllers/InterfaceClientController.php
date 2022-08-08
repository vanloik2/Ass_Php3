<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InterfaceClientController extends Controller
{

    public function homePage()
    {

        $data['products'] = Product::select('id', 'name', 'image', 'price', 'status')->where('status', 1)->orderBy('name', 'ASC')->get();
        $data['productss'] = Product::select('id', 'name', 'image', 'price', 'status')->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('client.home_page', $data);
    }

    public function showProducts(Request $request)
    {

        $data['categories'] = Category::all();
        $data['category_id'] = $request->get('category_id');

        $data['products'] = Product::select('id', 'name', 'image', 'price', 'category_id')
            ->where('category_id', 'like', '%' . $data['category_id'] . '%')
            ->where('status', 1)->paginate(12);

        return view('client.product-page', $data);
    }

    public function productDetail($id)
    {

        $data['product'] = Product::find($id);
        return view('client.product-detail', $data);
    }

    public function contactUs()
    {
        return view('client.contact-us');
    }

    public function carts()
    {

        $data['carts'] = Session::get('carts');

        if (!$data['carts']) {
            return view('client.empty-cart');
        }

        $total = 0;
        foreach ($data['carts'] as $cart) {

            $total += $cart['price'] * $cart['quant'];

        }
        $data['total'] = number_format($total, 0, ',', '.');

        return view('client.cart', $data);
    }

    public function addToCart(Product $product, Request $request)
    {
        $product->quant = $request->quant;

        if (Session::get('carts') == null) {
            $carts = [];
            $carts[$product->id] = $product;
            Session::put('carts', $carts);

            return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
        } else {
            $carts = Session::get('carts');
            if (array_key_exists($product->id, $carts)) {
                $carts[$product->id]->quant += $product->quant;
            } else {
                $carts[$product->id] = $product;
            }
            Session::put('carts', $carts);
        }
        return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
    }

    public function removeItemCart($id)
    {

        $carts = Session::get('carts');
        unset($carts[$id]);
        Session::put('carts', $carts);
        return redirect()->back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
    }

    public function order(){

        $data['orders'] = Order::select('id', 'code', 'username', 'user_id', 'product_name', 'price', 'quantity', 'total', 'created_at')
        ->where('user_id', Auth::user()->id)
        ->paginate(4);

        return view('client.order', $data);

    }

    public function orderDetroy($id){

        $order = Order::find($id);

        $order->delete();

        return redirect()->route('order')->with('success', 'Xóa đơn hàng thành công');

    }

    public function contactStore(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $contact = new Contact($request->all());

        $contact->save();

        return redirect()->back()->with('success', 'Gửi thành công');

    }

    //checkout

    public function checkout(){

        $order = new Order();

        $order->code = 'DH' . rand(1, 1000);
        $order->username = Auth::user()->name;
        $order->user_id = Auth::user()->id;

        foreach (Session::get('carts') as $cart) {
            $order->product_name .= $cart['name'] . ',';
            $order->price .= $cart['price'] . ',';
            $order->quantity .= $cart['quant'] . ',';
        }

        $total = 0;
        foreach (Session::get('carts') as $cart) {

            $total += $cart['price'] * $cart['quant'];

        }
        $order->total = number_format($total, 0, ',', '.');

        $order->save();
        Session::forget('carts');

        return back()->with('success', 'Đặt hàng thành công');

    }
}
