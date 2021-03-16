<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'Comment';
    protected $fillable = [
        'gameId',
        'author',
        'message',
        'destinationId',
        'likes',
        'dislikes'
    ];

    public function GetUser(){
        return User::where('username', $this->author)->first();
    }

    public function GetReplies(){
        return Comment::where('destinationId', $this->id)->get();
    }

}
