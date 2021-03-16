<?php

namespace App\Http\Controllers\Game;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(Request $request, $gameName){
        $this->validateComment($request);
        Comment::Create([
            'gameId'=>$gameName,
            'author'=>Auth::user()->username,
            'message'=>$request->input($request->name)
        ]);
        return back();
    }

    public function postReply(Request $request, $gameName, $commentId){
        $this->validateComment($request);
        Comment::Create([
            'gameId'=>$gameName,
            'author'=>Auth::user()->username,
            'message'=>$request->input($request->name),
            'destinationId'=>$commentId
        ]);
        return back();
    }

    private function validateComment($request){
        return $this->validate($request, [
            $request->name => 'required|max:500'
        ]);
    }
}
