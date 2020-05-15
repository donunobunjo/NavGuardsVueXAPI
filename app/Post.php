<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\PostImage;
class Post extends Model
{
    protected $fillable =['title','content','user_id'];

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function post_images(){
        return $this->hasMany(PostImage::class);
    }
}
