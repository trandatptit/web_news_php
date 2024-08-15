<?php

namespace App\Http\Controllers\Admin;
use DB;
use File;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLevel;
use App\Models\System;
use App\Models\Page;
use App\Http\Controllers\Controller;

class BackController extends Controller
{
    public function __construct(){
        @session_start();
    }
    public function home(){
        return view('admin.home');
    }
    // staff_management--------------------------------------------------
    public function staff_profile(){
        return view('staff.profile');
    }

    public function staff_profile_post(Request $request){
        if(empty($request->fullname) || empty($request->email) || empty($request->phone)) {
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đủ thông tin bắt buộc.']);
        }
         
        $user = User::find($request->id);
        if(!$user) {
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Người dùng không tồn tại.']);
        }
    
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone = $request->phone;
    
        if(isset($request->password) && !empty($request->password)){
            $user->password = bcrypt($request->password);
        }
    
        $flag = $user->save();
    
        if($flag){
            return redirect('admin/staff/profile')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật tài khoản thành công.']);
        } else{
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Chỉnh sửa không thành công.']);
        }
    }

    public function staff_list(){
        $User = DB::table('users as a')
        -> join('users_level as b', 'a.level', '=', 'b.id')
        -> selectRaw('a.id, a.fullname, a.address, a.email, a.phone, b.name')->get();
        return view('staff.list', compact('User'));
    }

    public function staff_add(){
        $UserLevel = UserLevel::where('status', 1)->get();

        return view('staff.add', compact('UserLevel'));
    }

    public function staff_add_post(Request $request){
        if(empty($request->fullname) || empty($request->email) || empty($request->phone) || empty($request->username) || empty($request->password)) {
            return redirect('admin/staff/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đủ thông tin bắt buộc.']);
        }
        $User = new User;
        $User->level = $request -> level;
        $User->status = 1;
        $User->username = $request -> username;
        $User->password =  bcrypt($request->password);
        $User->fullname = $request -> fullname;
        $User->address = $request -> address;
        $User->email = $request -> email;
        $User->phone = $request -> phone;
        $Flag = $User -> save();

        if($Flag){
            return redirect('admin/staff/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm nhân viên thành công.']);
        } else{
            return redirect('admin/staff/list')->with(['flash_level' => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }

    public function staff_edit(Request $request, $id){
        $User = User::find($id);
        $UserLevel = UserLevel::where('status', 1)->get();

        return view('staff.edit', compact('User','UserLevel'));
    }

    public function staff_edit_post(Request $request, $id){
        if(empty($request->fullname) || empty($request->email) || empty($request->phone)) {
            return redirect('admin/staff/edit')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đủ thông tin bắt buộc.']);
        }
        $User = User::find($id);
        $User->level = $request -> level;
        $User->status = $request -> status;
        if(isset($request->password) && !empty($request->password)){
            $User->password = bcrypt($request->password);
        }
        $User->fullname = $request -> fullname;
        $User->address = $request -> address;
        $User->email = $request -> email;
        $User->phone = $request -> phone;
        $Flag = $User -> save();

        if($Flag){
            return redirect('admin/staff/edit/'.$id)->with(['flash_level' => 'success', 'flash_message' => 'Chỉnh sửa nhân viên thành công.']);
        } else{
            return redirect('admin/staff/edit/'.$id)->with(['flash_level' => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }

    public function staff_delete(Request $request, $id){
        $User = User::find($id);
        $Flag = $User->delete();
        if($Flag){
            return redirect('admin/staff/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công.']);
        } else{
            return redirect('admin/staff/list')->with(['flash_level' => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }
    // staff_management--------------------------------------------------
    

    // system_management--------------------------------------------------

    public function system(){
        $name = System::where('Status', 1)->where('Code', 'name')->first();
        $logo = System::where('Status', 1)->where('Code', 'logo')->first();
        $favicon = System::where('Status', 1)->where('Code', 'favicon')->first();
        $email = System::where('Status', 1)->where('Code', 'email')->first();
        $phone = System::where('Status', 1)->where('Code', 'phone')->first();
        $address = System::where('Status', 1)->where('Code', 'address')->first();

        return view('admin.system', compact('name','logo','favicon','email','phone','address'));
    }

    public function system_post(Request $request){
        if(empty($request->name) || empty($request->email) || empty($request->phone)) {
            return redirect('admin/system')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đủ thông tin bắt buộc.']);
        }

        // update ten cong ty
        System::where('Status', 1)
        ->where('Code', 'name')
        ->update(['Description'=>$request->name]);
        // update email
        System::where('Status', 1)
        ->where('Code', 'email')
        ->update(['Description'=>$request->email]);
        // update phone
        System::where('Status', 1)
        ->where('Code', 'phone')
        ->update(['Description'=>$request->phone]);
        // update dia chi
        System::where('Status', 1)
        ->where('Code', 'address')
        ->update(['Description'=>$request->address]);

        //update logo
        if(!empty($request->file('logo'))){
            $logo = System::where('Status', 1)->where('Code', 'logo')->first();
            $path = public_path('images/logo/'.$logo->Description);
            if(file_exists($path)){
                File::delete($path);
            }
            //upload image
            $name = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('images/logo/'), $name);

            $logo->Description = $name;
            $logo->save();
        }

        //update favicon
        if(!empty($request->file('favicon'))){
            $favicon = System::where('Status', 1)->where('Code', 'favicon')->first();
            $path = public_path('images/favicon/'.$favicon->Description);
            if(File::exists($path)){
                File::delete($path);
            }
            //upload image
            $name = $request->file('favicon')->getClientOriginalName();
            $request->file('favicon')->move(public_path('images/favicon/'), $name);

            $favicon->Description = $name;
            $favicon->save();
        }
        
        return redirect('admin/system')->with(['flash_level' => 'success', 'flash_message' 
            => 'Chỉnh sửa thành công.']);
    }
    // system_management--------------------------------------------------


    // page_management--------------------------------------------------

    // public function page_list(){
    //     $Page = Page::get();
    //     return view('page.list', compact('Page'));
    // }

    // page_management--------------------------------------------------

}

