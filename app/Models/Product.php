<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title','content','author','img','category_id','user_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function usersLiked(){
        return $this->belongsToMany(User::class,'user_book')
            ->withTimestamps();
    }
    public function userSubs(){
        return $this->belongsToMany(User::class)
            ->withPivot('month')
            ->withTimestamps();
    }
    public function usersRated(){
        return $this->belongsToMany(User::class)
            ->withPivot('rating')
            ->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
