<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function getAllPosts(){
        $post = Post::with('post_images')->orderBy('created_at','desc')->get();
        return Response::json(['error'=>false,'data'=>$post]);
    }

    public function createPost(Request $request){
        $user = Auth::user();
        $title =$request->title;
        $content =$request->content;
        $images=$request->images;
        $post = Post::create([
            'title'=>$title,
            'content'=>$content,
            'user_id'=>$user->id
        ]);
        foreach($images as $image) {
            $imagePath = Storage::disk('uploads')->put($user->email . '/posts/' . $post->id, $image);
            PostImage::create([
                'post_image_caption' => $title,
                'post_image_path' => '/uploads/' . $imagePath,
                'post_id' => $post->id
            ]);
        }


        return Response::json(['msg'=>'e don happen']);

       
    }
}
