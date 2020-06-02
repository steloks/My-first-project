<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class Post extends Model
{
    protected $guarded=[];
    public function user(){
        return $this->belongsTo(User::class);
}
    public function comment(){
        return $this->hasMany(Comments::class);
    }

}
