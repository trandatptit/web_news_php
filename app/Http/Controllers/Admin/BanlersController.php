<?php

namespace App\Http\Controllers\Admin;

use DB;
use File;
use voku\helper\ASCII;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLevel;
use App\Models\System;
use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Banler;
use App\Http\Controllers\Controller;

class BanlersController extends Controller
{
    public function __construct()
    {
        @session_start();
    }

    public function banlers_list()
    {
        $Banler = Banler::all();
        return view("banler.list", compact("Banler"));
    }

    public function banlers_add()
    {
        return view("banler.add");
    }

    public function banlers_add_post(Request $request)
    {
        if (empty($request->ten) && empty($request->hinh) && empty($request->noidung) && empty($request->link)) {
            return redirect('admin/banlers/add')->with(['flash_level'
            => 'danger', 'flash_message' => 'Vui lòng điền đủ thông tin bắt buộc.']);
        }
        $Banler = new Banler;
        $Banler->ten = $request->ten;
        $Banler->noidung = $request->noidung;
        $Banler->link = $request->link;

        $file = $request->file('hinh');
        $duoi = $file->getClientOriginalExtension();
        if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
            return redirect('admin/banlers/add')->with(['flash_level'
            => 'danger', 'flash_message' => 'Bạn hcir được chọn file có đuôi jpg, png, jpeg!']);
        }
        $name = $file->getClientOriginalName();
        $banler = Str::random(4) . "_" . $name;
        while (file_exists("images/banler/" . $banler)) {
            $banler = Str::random(4) . "_" . $name;
        }
        $file->move(public_path('images/banler/'), $banler);
        $Banler->hinh = $banler;

        $Flag = $Banler->save();

        if ($Flag) {
            return redirect('admin/banlers/list')->with(['flash_level'
            => 'success', 'flash_message' => 'Thêm banler thành công.']);
        } else {
            return redirect('admin/banlers/list')->with(['flash_level'
            => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }

    public function banlers_edit(Request $request, $id)
    {
        $Banler = Banler::find($id);
        return view('banler.edit', compact('Banler'));
    }

    public function banlers_edit_post(Request $request, $id)
    {
        // Kiểm tra các trường bắt buộc
        if (empty($request->ten) || empty($request->noidung) || empty($request->link)) {
            return redirect('admin/banlers/edit/' . $id)->with([
                'flash_level' => 'danger',
                'flash_message' => 'Vui lòng điền đủ thông tin bắt buộc.'
            ]);
        }

        $Banler = Banler::find($id);
        if (!$Banler) {
            return redirect('admin/banlers')->with([
                'flash_level' => 'danger',
                'flash_message' => 'Không tìm thấy banner.'
            ]);
        }

        $Banler->ten = $request->ten;
        $Banler->noidung = $request->noidung;
        $Banler->link = $request->link;

        // Kiểm tra và xử lý tệp hình ảnh
        if ($request->hasFile('hinh')) {
            $file = $request->file('hinh');
            $duoi = $file->getClientOriginalExtension();
            if (!in_array($duoi, ['jpg', 'png', 'jpeg'])) {
                return redirect('admin/banlers/edit/' . $id)->with([
                    'flash_level' => 'danger',
                    'flash_message' => 'Bạn chỉ được chọn file có đuôi jpg, png, jpeg!'
                ]);
            }

            $name = $file->getClientOriginalName();
            $banler = Str::random(4) . "_" . $name;
            while (file_exists(public_path("images/banler/" . $banler))) {
                $banler = Str::random(4) . "_" . $name;
            }

            // Xóa hình cũ nếu tồn tại
            if (!empty($Banler->hinh) && file_exists(public_path("images/banler/" . $Banler->hinh))) {
                unlink(public_path("images/banler/" . $Banler->hinh));
            }

            // Lưu tệp mới
            $file->move(public_path('images/banler/'), $banler);
            $Banler->hinh = $banler;
        }

        // Lưu bản ghi
        $Flag = $Banler->save();

        if ($Flag) {
            return redirect('admin/banlers/edit/' . $id)->with([
                'flash_level' => 'success',
                'flash_message' => 'Sửa banner thành công.'
            ]);
        } else {
            return redirect('admin/banlers/edit/' . $id)->with([
                'flash_level' => 'danger',
                'flash_message' => 'Xảy ra lỗi.'
            ]);
        }
    }

    public function banlers_delete($id)
    {

        $Banler = Banler::find($id);
        $Flag = $Banler->delete();
        if ($Flag) {
            return redirect('admin/banlers/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công.']);
        } else {
            return redirect('admin/banlers/list')->with(['flash_level' => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }
}
