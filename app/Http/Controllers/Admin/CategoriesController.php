<?php

namespace App\Http\Controllers\Admin;
use DB;
use File;
use voku\helper\ASCII;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLevel;
use App\Models\System;
use App\Models\Category;
use App\Models\Page;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function __construct(){
        @session_start();
    }
    
    public function categories_list(){
        $Category = Category::get();
        return view('categories.list', compact('Category'));
       
    }
    
    public function categories_add(){
        // $UserLevel = UserLevel::where('status', 1)->get();

        return view('categories.add');
    }

    public function categories_add_post(Request $request){
        if(empty($request->name)) {
            return redirect('admin/categories/add')->with(['flash_level' 
                => 'danger', 'flash_message' => 'Vui lòng điền đủ thông tin bắt buộc.']);
        }
        $Category = new Category;
        $Category->name = $request -> name;

        $slug = $request->name;
        $slug = ASCII::to_ascii($slug);
        $slug = mb_strtolower($slug);
        $slug = preg_replace('/\s+/', '-', $slug); 
        $Category->slug = $slug;


        $Flag = $Category -> save();

        if($Flag){
            return redirect('admin/categories/list')->with(['flash_level' 
                => 'success', 'flash_message' => 'Thêm danh mục thành công.']);
        } else{
            return redirect('admin/categories/list')->with(['flash_level'
                => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }

    public function categories_edit(Request $request, $id){
        $Category = Category::find($id);

        return view('categories.edit', compact('Category'));
    }

    public function categories_edit_post(Request $request, $id){
        if(empty($request->name)) {
            return redirect('admin/categories/edit')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đủ thông tin bắt buộc.']);
        }
        $Category = Category::find($id);
        $Category->name = $request -> name;

        $slug = $request->name;
        $slug = ASCII::to_ascii($slug);
        $slug = mb_strtolower($slug);
        $slug = preg_replace('/\s+/', '-', $slug); 
        $Category->slug = $slug;
        
        $Flag = $Category -> save();
        if($Flag){
            return redirect('admin/categories/edit/'.$id)->with(['flash_level' => 'success', 'flash_message' => 'Chỉnh sửa danh mục thành công.']);
        } else{
            return redirect('admin/categories/edit/'.$id)->with(['flash_level' => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }

    public function categories_delete(Request $request, $id){
        $Category = Category::find($id);
        $Flag = $Category->delete();
        if($Flag){
            return redirect('admin/categories/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công.']);
        } else{
            return redirect('admin/categories/list')->with(['flash_level' => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }
}

