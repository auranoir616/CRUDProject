<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    protected $table = 'follower';
    protected $fillable = ['user_id,following_user'];

    public function postfollowingUser(){
        return $this->belongsTo(Post::class,'following_user', 'user_id');
    }
    
}
