<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
    public function index()
    {
        $users = User::latest('id')->paginate(5); //latest('id') sắp xếp kết quả theo cột id theo thứ tự giảm dần, paginate(5) phân trang kết quả, mỗi trang có tối đa 5 bản ghi.
        return view('users.index', compact('users')); //compact('users') chứa biến $users được truyền vào view để hiển thị trong giao diện người dùng.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Hàm store: sử dụng để xử lý quá trình lưu dữ liệu mới vào cơ sở dữ liệu, thường là từ một biểu mẫu được gửi từ giao diện người dùng.
    public function store(CreateUserRequest $request)
    {
        $dataCreate = $request->all(); //lấy tất cả dữ liệu từ yêu cầu HTTP ($request)
        $dataCreate['password'] = Hash::make($request->password);
        $user = User::create($dataCreate);

        return redirect()->route('users.index')->with(['message' => "Create $user->name success"]);
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
        $user = User::findOrFail($id); //findOrFail tìm kiếm một bản ghi với giá trị khóa chính là $id

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $dataUpdate = $request->except('password'); // except: khi mà update lại dữ liệu sẽ không lấy trường password
        if($request->password)
        {
            $dataUpdate['password'] = Hash::make($request->password);
        }
        $user->update($dataUpdate);
        return redirect()->route('users.index')->with(['message' => 'Update Success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete($user);
        return redirect()->route('users.index')->with(['message' => 'Delete Success']);
    }
}
