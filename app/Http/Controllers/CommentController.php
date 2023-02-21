<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
class CommentController extends Controller
{
    public function store(Request $req){
        $validated=$req->validate([
            'content'=>'required',
            'product_id'=>'required|numeric|exists:products,id',
        ]);
        Auth::user()->comments()->create($validated);
        return back()->with("Comments is created sucsessfully");
    }

    public function edit(Comment $comment){
        return view('comment.edit',['comment'=>$comment,'categories'=>Category::all()]);
    }

    public function update(Request $req,comment $comment){
        $comment->update([
            'content'=>$req->input('content'),
            'product_id'=>$req->input('product_id'),

        ]);
        return redirect(route('products.show',[$comment->product_id]));
    }

    public function destroy(Comment $comment){
        $this->authorize('delete',$comment);
        $comment->delete();
        return redirect(route('products.show',[$comment->product_id]));
    }

}
