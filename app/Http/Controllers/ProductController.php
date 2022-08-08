<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Bảng sản phẩm';
        $data['categories'] = Category::all();
        $data['category_id'] = $request->get('category_id');
        $data['txt_search'] = $request->get('txt_search');

        $data['products'] = Product::with('category')->where('name', 'like', '%' . $data['txt_search'] . '%')
        ->where('category_id', 'like', '%' . $data['category_id'] . '%')
        ->paginate(4)->withQueryString();

        return view('admin.table.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Thêm sản phẩm';
        $data['categories'] = Category::all();

        return view('admin.table.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $product = new Product($request->all());

        if ($request->hasFile('image')) {

            $image = $request->image;
            $imageName = $image->hashName();
            $imageName = $request->name . '_' . $imageName;

            $product->image = $image->storeAs('images/products', $imageName);
        }

        $product->save();

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Sửa sản phẩm';
        $data['product'] = Product::find($id);
        $data['categories'] = Category::all();

        return view('admin.table.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);

        $product->fill($request->all());
      
        if ($request->hasFile('image')) {

            $image = $request->image;
            $imageName = $image->hashName();
            $imageName = $request->name . '_' . $imageName;

            $product->image = $image->storeAs('images/products', $imageName);
        }

        $product->save();

        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return back()->with('success', 'Xóa sản phẩm thành công');
    }

    public function changeStatus(Product $product)
    {

        if ($product->status === 1) {
            $product->status = 2;
        } else {
            $product->status = 1;
        }

        $product->save();
        
        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
}
