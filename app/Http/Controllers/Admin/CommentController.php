<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment; 

class CommentController extends Controller
{
    //
    public function index()
    {
    	return view('admin/comment/index')->withComments(Comment::all());
    }

    public function edit($id)
    {
    	return view('admin/comment/edit')->withComment(Comment::find($id));
    }

    public function update(Request $request, $id)
    {
    	$comment = Comment::find($id);
    	$comment->content = $request->get('content');

    	if($comment->save()) {
    		return redirect('admin/comment');
    	} else {
    		return redirect()->back()->withInput()->withErrors('保存失败！');
    	}
    }

    public function destroy($id)
    {
    	Comment::find($id)->delete();
    	return redirect()->back()->withInput()->withErrors('删除成功!');
    }

}
