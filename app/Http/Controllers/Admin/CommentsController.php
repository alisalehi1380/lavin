<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
 
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('comments.index');
        
       $comments = Comment::with('commentable')->orderBy('created_at','desc')->filter()->paginate(10);
       return  view('admin.comment.all',compact('comments'));
    }

 
    public function create()
    {
  
    }

 
    public function store(Request $request)
    {
   
    }

 
    public function show($id)
    {
        //
    }

 
    public function edit($id)
    {
        //
    }
 
    public function update(Comment $comment,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('comments.update');

        $comment->answer = $request->answer;
        $comment->approved = $request->status;
        $comment->save();

        toast('بروزرسانی انجام شد.','success')->position('bottom-end');    
        return back();
    }

 
    public function destroy(Comment $comment)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('comments.destroy');

        $comment->delete();
        toastr()->error('مقاله مورد نظر شد.');
        return back();
    }
}
