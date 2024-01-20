<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = ['id_post,body,user_id'];
    //setiap komentar milik table Post dengan kunci 'post_id'
    public function UsersComment2(){
        return $this->belongsTo(Post::class, 'id_post', 'id');
    }
}
