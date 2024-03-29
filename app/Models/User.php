<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Likes;
use App\Models\Follow;
use App\Models\Messages;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = ['name','username','email','password','Images_profile','bio'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    //relasi antera table user dan post dengan user_id
    public function UsersPosts(){
        return $this->hasmany(Post::class, 'user_id');
    }

    public function Liked(){
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }    

    public function followedUser() {
    return $this->belongsToMany(User::class, 'follower', 'user_id', 'following_user');
    }
    public function messages()
{
    return $this->hasMany(Messages::class, 'recipient_id')->latest();
}
    

}




