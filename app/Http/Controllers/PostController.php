<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

public function index()
{

    $posts= new Post;
    $posts = Post::all();
   
   return view('admin.posts.index',['posts'=>$posts]);
   }

   public function  show(Post $post)
   {
     
    return view('blog-post',['post'=>$post]);
   }

   public function create()
   {
      $this->authorize('create',Post::class);
      return view('admin.posts.create');
   }

   public function store()
   {
      $this->authorize('create',Post::class);

     $inputs = request()->validate([
      
         'title'=>'required',
         'post_image'=>'file',
         'body'=>'required'
         ]);
      if(request('post_image'))
      {

         $inputs['post_image'] = request('post_image')->store('images');

         auth()->user()->posts()->create($inputs);
         Session::flash('post-update-message','Post Was Created Succesfully');
         return redirect()->route('post.index');
      }

   }
   public function destroy(Post $post){

      $this->authorize('delete',$post);
      $post->delete();

      Session::flash('message','Post Was Deleted succesfully');

      return back();
   }
   
   public function edit(Post $post)
   {
      $this->authorize('view',$post);
      return view('admin.posts.edit',['post'=>$post]);
   }
 
   public function update(Post $post)
   {
     $inputs = request()->validate([
      
         'title'=>'required',
         'post_image'=>'file',
         'body'=>'required'
         ]);
      if(request('post_image')){
          $inputs['post_image'] = request('post_image')->store('images');
          $post->post_image =$inputs['post_image'];
      }
        $post->title = $inputs['title'];   
        $post->body = $inputs['body'];  
        
      $this->authorize('update',$post);

      $post->update();
        Session::flash('post-update-message','Post Was Updated succesfully');
        return redirect()->route('post.index');
   }
}


