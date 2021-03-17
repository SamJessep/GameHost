<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'Comment';
    protected $primaryKey = "id";
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

    public function GetFormatedPostDate(){
        $creation_date=date_create($this->created_at);
        $now=date_create();
        $diff=date_diff($creation_date,$now);
        $seconds = $diff->format("%s");
        $minutes = $diff->format("%i");
        $hours = $diff->format("%h");
        $days = $diff->format("%a");
        $months = $diff->format("%m");
        $years = $diff->format("%y");

        if($years != 0){
            return $years." year".($years==1?"":"s" )." ago";
        }
        if($months != 0){
            return $months." month".($months==1?"":"s" )." ago";
        }
        if($days != 0){
            return $days." day".($days==1?"":"s" )." ago";
        }
        if($hours != 0){
            return $hours." hour".($hours==1?"":"s" )." ago";
        }
        if($minutes != 0){
            return $minutes." minute".($minutes==1?"":"s" )." ago";
        }
        return $seconds." second".($seconds==1?"":"s" )." ago";
    }

}
