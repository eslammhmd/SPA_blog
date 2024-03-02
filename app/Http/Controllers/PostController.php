<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use auth;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index(Request $request){
        if($request->category)
        {
            return  PostResource::collection(Category::where('name' , $request->category)
            ->firstOrFail()->posts()->latest()->paginate(1)->withQueryString());
            
        }else if($request->search){
            return PostResource::collection(Post::where('title' , 'like', '%'.$request->search.'%')
                ->orWhere('body','like' , '%'.$request->search.'%')->latest()->paginate(1)->withQueryString());
        }
        return PostResource::collection(Post::latest()->paginate(1));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'file' => 'required | image' ,
            'body' => 'required',
            'category_id' => 'required',
        ]);

        $title = $request->title;
        $category_id = $request->category_id;


        if(!Post::count()){
            $postId = 1;
        }else{
            $postId = Post::latest('id') ->first()->id+ 1 ;
        }


        $slug = Str::slug($title , '-') . '-' . $postId;

        // refactors
        $user_id = 12;
        $body = $request->input('body');
        $imgPath = 'storage/' . $request->file('file')->store('postsImages' , 'public');



        // create and save post
        $post = new Post();
        $post->title = $title;
        $post->category_id = $category_id;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->body = $body;
        $post->img_path = $imgPath;

        $post->save();

    }







    public function show(Post $post){
        return new PostResource($post);
    }





}
