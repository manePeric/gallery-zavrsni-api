<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store($id, CreateCommentRequest $request)
    {
        $data = $request->validated();

        $gallery = Gallery::with([
            "images",
            "user",
            "comments",
            "comments.user",
        ])->find($id);
        $comment = new Comment();
        $comment->content = $data["content"];
        $comment->user()->assosciate(Auth::user());
        $comment->gallery()->associate($gallery);
        $comment->save();
    }
}