<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['content','product_id','user_id'];

    use HasFactory;

    public function product(){

        return $this->belongsTo(Book::class);

    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
