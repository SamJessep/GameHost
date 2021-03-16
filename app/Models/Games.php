<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Games extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'author',
        'description',
        'gameUrl',
        'thumbnailImage',
        'gallaryImages',
        'status'
    ];

    public function authorUser(){
        return User::where('username', $this->author)->first();
    }

    public function GetComments(){
        return Comment::where('gameId', $this->name)->where('destinationId', null)->get();
    }
}
