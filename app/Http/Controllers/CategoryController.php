<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Bảng danh mục sản phẩm';
        $data['txt_search'] = $request->get('txt_search');
        $data['categories'] = Category::select('id', 'name', 'image')->where('name', 'like', '%' . $data['txt_search'] . '%')->paginate(5)->withQueryString();

        return view('admin.table.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Thêm mới danh mục sản phẩm';

        return view('admin.table.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category($request->all());

        if($request->hasFile('image')){

            $image = $request->image;
            $imageName = $image->hashName();
            $imageName = $request->name . '_' . $imageName;

            $category->image = $image->storeAs('images/categories', $imageName);
        }

        $category->save();

        return redirect()->route('category.index')->with('success', 'Thêm mới danh mục sản phẩm thành công');

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $products = Product::where('category_id', $id)->get();

        foreach ($products as $product) {
            $product->delete();
        }

        $category->delete();

        return back()->with('success', 'Xóa danh mục sản phẩm thành công');
    }
}
