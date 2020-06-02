<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded=[];
    protected $table = 'messages';
    public function user(){
        return $this->belongsTo(User::class,'id','from_user_id');
    }
}
