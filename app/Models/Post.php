<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable = ['title', 'body','images', 'user_id'];

    //relasi antara table post denagan user
    public function UsersPosts2(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function UserComment(){
        return $this->hasmany(Comment::class, 'post_id');
    }


}

