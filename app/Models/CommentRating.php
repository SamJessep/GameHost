<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentRating extends Model
{
    use HasFactory;
    protected $table = 'comment_rating';
    protected $primaryKey = "id";
    protected $fillable = [
        'commentId',
        'userId',
        'rating'
    ];

    public function GetUser(){
        return User::where('username',$this->userId)->first(); 
    }
}
