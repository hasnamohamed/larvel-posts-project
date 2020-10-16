<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //to use post model
use DB;//tp read from db queries
use Illuminate\Support\Facades\DB as FacadesDB;

class Postcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);//it is meaning that if the person is auth thats mean he is login he can see everything bu if he is not an auth he can just see show and index pages just that pages every other page will require login to be an auth and see it
    }
    public function index(){
        //$posts = Post::all();
        //$posts = Post::take(5)->get();
        //$posts= DB::select('select * from posts');
        $posts=Post::orderBy('id','desc')->paginate(5);//here we read from model we can also read from db
        $count=Post::count();
        return view('posts.index',compact('posts','count'));
    }
    public function show($id){
       $post = Post::find($id);
       return view('posts.show', compact('post'));
    }
    public function create(){
       return view('posts.create');
    }
    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:200',// required means require to add it
            'body'=>'required|max:500',
            'coverImage'=>'image|mimes:jpeg,bmp,png,jpg|max:1999'
        ]);
        if($request->hasFile('coverImage'))
        {
            $file=$request->file('coverImage');
            $ext= $file->getClientOriginalExtension();
            $filename='cover_image' . '_' . time() . '.' . $ext;
           $file->storeAs('public/coverImages', $filename);
        }
        else{
            $filename = 'noimage.png';
        }
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->image = $filename;
        $post->save();
        return redirect('/posts')->with('status', 'Post was created !');
    }


        //edit post form
        public function edit($id){

            $post = Post::find($id);
            if( auth()->user()->id !== $post->user_id ) {
                return redirect('/posts')->with('error', 'You are not authorized !');
            }
            return view('posts.edit', compact('post'));
        }
    //update
    public function update(Request $request, $id){
        $request->validate([
            'title'=>'required|max:200',// required means require to add it
            'body'=>'required|max:500'
        ]);
        $post = Post::find($id);
        $post->title= $request->title;
        $post->body= $request->body;
        $post->save();
        return redirect('/posts')->with('status', 'Post was updated !');

    }
   public function destroy($id){
    $post = Post::find($id);
    $post->delete();
    return redirect('/posts')->with('status', 'Post was deleted !');

   }

}
