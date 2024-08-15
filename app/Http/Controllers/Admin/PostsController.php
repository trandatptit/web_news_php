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
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function __construct()
    {
        @session_start();
    }

    public function posts_list()
    {
        $Post = Post::all();

        // $Post =DB::table('posts as a')
        // -> join('categories as b', 'a.category_id', '=', 'b.id')
        // -> selectRaw('a.id, a.title, a.slug, a.excerpt, a.body, b.name, a.views, a.approved, a.created_at')->get();
        return view('post.list', compact('Post'));
    }

    public function posts_add()
    {
        $Category = Category::all();
        return view('post.add', compact('Category'));
    }

    public function posts_add_post(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ], [
            'category_id.required' => 'Bạn chưa chọn thể loại',
            'title.required' => 'Bạn chưa nhập tiêu đề',
            'excerpt.required' => 'Bạn chưa nhập tóm tắt',
            'body.required' => 'Bạn chưa nhập nội dung'
        ]);

        $Post = new Post;
        $Post->title = $request->title;
        $Post->slug = $request->slug;
        $Post->excerpt = $request->excerpt;
        $Post->category_id = $request->category_id;
        $Post->body = $request->body;
        $Post->views = 0;
        $Post->approved = $request->approved;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/posts/add')->with(['flash_level'
                => 'danger', 'flash_message' => 'Bạn hcir được chọn file có đuôi jpg, png, jpeg!']);
            }
            $name = $file->getClientOriginalName();
            $avatar = Str::random(4) . "_" . $name;
            while (file_exists("images/avatar_post/" . $avatar)) {
                $avatar = Str::random(4) . "_" . $name;
            }
            $file->move(public_path('images/avatar_post/'), $avatar);
            $Post->avatar = $avatar;
        } else {
            $Post->avatar = "";
        }
        $Flag = $Post->save();

        if ($Flag) {
            return redirect('admin/posts/list')->with(['flash_level'
            => 'success', 'flash_message' => 'Thêm bài viết thành công.']);
        } else {
            return redirect('admin/posts/list')->with(['flash_level'
            => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }

    public function posts_edit(Request $request, $id)
    {
        $Category = Category::all();
        $Post = Post::find($id);
        return view('post.edit', compact('Post', 'Category'));
    }

    public function posts_edit_post(Request $request, $id)
    {
        $Post = Post::find($id);
        $validated = $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ], [
            'category_id.required' => 'Bạn chưa chọn thể loại',
            'title.required' => 'Bạn chưa nhập tiêu đề',
            'excerpt.required' => 'Bạn chưa nhập tóm tắt',
            'body.required' => 'Bạn chưa nhập nội dung'
        ]);
        $Post->title = $request->title;
        $Post->slug = $request->slug;
        $Post->excerpt = $request->excerpt;
        $Post->category_id = $request->category_id;
        $Post->body = $request->body;
        $Post->approved = $request->approved;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/posts/add')->with(['flash_level'
                => 'danger', 'flash_message' => 'Bạn hcir được chọn file có đuôi jpg, png, jpeg!']);
            }
            $name = $file->getClientOriginalName();
            $avatar = Str::random(4) . "_" . $name;
            while (file_exists("images/avatar_post/" . $avatar)) {
                $avatar = Str::random(4) . "_" . $name;
            }
            if (!empty($Post->avatar) && file_exists("images/avatar_post/" . $Post->avatar)) {
                unlink("images/avatar_post/" . $Post->avatar);
            }
            $file->move(public_path('images/avatar_post/'), $avatar);
            $Post->avatar = $avatar;
        }
        $Flag = $Post->save();

        if ($Flag) {
            return redirect('admin/posts/edit/'.$id)->with(['flash_level'
            => 'success', 'flash_message' => 'Sửa bài viết thành công.']);
        } else {
            return redirect('admin/posts/edit/'.$id)->with(['flash_level'
            => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }


    }

    public function posts_delete($id)
    {
        $Post = Post::find($id);
        $Flag = $Post ->delete();
        if($Flag){
            return redirect('admin/posts/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công.']);
        } else{
            return redirect('admin/posts/list')->with(['flash_level' => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }
    public function posts_comment_delete($id)
    {
        $Comment = Comment::find($id);
        $Post_id = $Comment->post->id;
        $Flag = $Comment->delete();
        if($Flag){
            return redirect('admin/posts/edit/'.$Post_id)->with(['flash_level' => 'success', 'flash_message' => 'Xóa bình luận thành công.']);
        } else{
            return redirect('admin/posts/edit/'.$Post_id)->with(['flash_level' => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }
}
