<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable =['post_id','post_image_path','post_image_caption'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
   
}
