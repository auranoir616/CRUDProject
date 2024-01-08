<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = ['post_id,body,user_id'];

    public function UsersComment2(){
        return $this->belongsTo(Post::class, 'post_id');
    }
}
