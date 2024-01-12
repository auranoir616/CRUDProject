<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $fillable = ['user_id','content','recipient_id'];
    protected $dates = ['send_at'];

    public function Sender(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function Reciever(){
        return $this->belongsTo(User::class,'recipient_id');
    }

}
