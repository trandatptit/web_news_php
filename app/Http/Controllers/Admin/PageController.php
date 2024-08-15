<?php

namespace App\Http\Controllers\Admin;

use DB;
use File;
use voku\helper\ASCII;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserLevel;
use App\Models\System;
use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Banler;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct()
    {
        @session_start();
        $Banler = Banler::all();
        $Category = Category::all();
        $Category_VH = Category::find(17);
        $Post_newest = Post::orderBy('created_at', 'desc')->take(4)->get();
        $Post_VH = $Category_VH->posts()->latest()->first();
        $name = System::where('Status', 1)->where('Code', 'name')->first();
        $logo = System::where('Status', 1)->where('Code', 'logo')->first();
        $favicon = System::where('Status', 1)->where('Code', 'favicon')->first();
        $email = System::where('Status', 1)->where('Code', 'email')->first();
        $phone = System::where('Status', 1)->where('Code', 'phone')->first();
        $address = System::where('Status', 1)->where('Code', 'address')->first();

        view()->share("Banler", $Banler);
        view()->share("Category", $Category);
        view()->share("Post_VH", $Post_VH);
        view()->share("name", $name);
        view()->share("logo", $logo);
        view()->share("email", $email);
        view()->share("phone", $phone);
        view()->share("address", $address);
        view()->share("favicon", $favicon);
        view()->share("Post_newest", $Post_newest);

        if (Auth::check()) {
            $nguoidung =  Auth::user();
            view()->share("nguoidung", $nguoidung);
        }
    }

    public function trangchu()
    {
        return view("pages.trangchu");
    }

    public function theloai($id)
    {
        $Category_id = Category::find($id);
        $Post_cate = Post::where('category_id', $Category_id->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('pages.theloai', compact('Category_id', 'Post_cate'));
    }

    public function baiviet($id)
    {
        $Post_id = Post::find($id);
        // Tăng số lượt xem
        $Post_id->increment('views');
        $tinlienquan = Post::where('category_id', $Post_id->category_id)
            ->where('id', '<>', $id) // Loại bỏ bài viết hiện tại
            ->take(4)
            ->get();
        return view('pages.baiviet', compact('Post_id', 'tinlienquan'));
    }

    public function getdangnhap()
    {
        return view('pages.dangnhap');
    }

    public function handleForm(Request $request)
    {
        // Kiểm tra giá trị của input ẩn 'form_type'
        if ($request->input('form_type') === 'dangnhap') {
            return $this->dangnhap($request); // Xử lý đăng nhập
        } elseif ($request->input('form_type') === 'dangky') {
            return $this->dangky($request); // Xử lý đăng ký
        } else {
            return redirect()->back()->with('notice', 'Invalid form submission.');
        }
    }

    public function dangnhap(Request $request)
    {
        if ($request->username == ' ' || $request->password  == ' ') {
            return redirect('/dangnhap')->with('notice', 'Tài khoản hoặc mật khẩu không được để trống');
        }
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/');
        } else {
            return redirect('/dangnhap')->with('notice', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }

    public function dangky(Request $request)
    {
        if (empty($request->fullname) || empty($request->email) || empty($request->phone) || empty($request->address) || empty($request->username) || empty($request->password)) {
            return redirect('dangnhap')->with('error', 'Vui lòng nhập đủ thông tin!');
        }
        $User = new User;
        $User->level = 2;
        $User->status = 1;
        $User->username = $request->username;
        $User->password =  bcrypt($request->password);
        $User->fullname = $request->fullname;
        $User->address = $request->address;
        $User->email = $request->email;
        $User->phone = $request->phone;
        $User->save();
        return redirect('dangnhap')->with('thongbao', 'Tạo tài khoản thành công! Hãy đăng nhập tại đây');
    }

    public function getdangxuat()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getNguoidung()
    {
        return view('pages.nguoidung');
    }

    public function postNguoidung(Request $request)
    {
        if (empty($request->fullname) || empty($request->address) || empty($request->phone)) {
            return redirect('nguoidung')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đủ thông tin bắt buộc.']);
        }
        $user = User::find(Auth::user()->id);
        if (isset($request->password) && !empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();
        return redirect('nguoidung')->with('thongbao', 'Chỉnh sửa thành công!');
    }

    public function timkiem(Request $request)
    {
        $tukhoa = $request->tukhoa;
        $post_search = Post::where('title', 'like', "%$tukhoa%")
            ->orWhere('excerpt', 'like', "%$tukhoa%")
            ->orWhere('body', 'like', "%$tukhoa%")
            ->take(20)
            ->paginate(5);
        return view("pages.timkiem", compact('post_search', 'tukhoa'));
    }
}
