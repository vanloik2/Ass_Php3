<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Bảng danh người dùng';
        $data['txt_search'] = $request->get('txt_search');
        $data['users'] = User::select('id', 'name', 'email', 'avatar', 'phone_number', 'address', 'role', 'status')->where('name', 'like', '%' . $data['txt_search'] . '%')->paginate(5)->withQueryString();

        return view('admin.table.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Thêm mới người dùng';

        return view('admin.table.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        
        $user->password = Hash::make($request->password);

        if($request->hasFile('avatar')){

            $avatar = $request->file('avatar');
            $avatarName = $avatar->hashName();
            $avatarName = $request->name . '-' . $avatarName;

            $user->avatar = $avatar->storeAs('images/avatars', $avatarName);
        }


        $user->save();

        return redirect()->route('user.index')->with('success', 'Thêm mới người dùng thành công');
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
        $user = User::find($id);

        $user->delete();

        return back()->with('success', 'Xóa người dùng thành công');    
    }

    public function changeStatus(User $user){

        if($user->status == 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái người dùng thành công');

    }
}
