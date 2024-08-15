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
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        @session_start();
    }

    public function comments_list()
    {
        $Comment = Comment::orderBy("id","desc")->paginate(10);
        return view('comment.list', compact('Comment'));
    }

    public function comments_delete($id)
    {
        $Comment = Comment::find($id);
        $Flag = $Comment->delete();
        if($Flag){
            return redirect('admin/comments/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công.']);
        } else{
            return redirect('admin/comments/list')->with(['flash_level' => 'danger', 'flash_message' => 'Xảy ra lỗi.']);
        }
    }

    // comment user gửi lên
    public function postComment($id, Request $request){
        $post = Post::find($id);
        $comment = new Comment;
        $comment->post_id = $id;
        $comment->user_id = Auth::user()->id;
        $comment->the_comment = $request->the_comment;
        $comment->save();
        return  redirect("baiviet/$id/".$post->slug.".html")->with(  "thongbao","Gửi bình luận thành công!");
    }
}
