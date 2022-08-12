<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class StatisController extends Controller
{
    public function index()
    {

        $data['title'] = 'Bảng thống kê';
        $slUser = User::all()->count();
        $slProduct = Product::all()->count();
        $slOrder = Order::all()->count();
        $slContact = Contact::all()->count();
        $slComment = Comment::all()->count();
        $slCate = Category::all()->count();


        $data['statis'] = [
            'slUser' => $slUser,
            'slProduct' => $slProduct,
            'slOrder' => $slOrder,
            'slContact' => $slContact,
            'slComment' => $slComment,
            'slCate' => $slCate,
        ];

        $statisMax = max($data['statis']);

        $data['statis']['max'] = max($data['statis']);

        return view('admin.table.statis.index', $data);
    }
}
