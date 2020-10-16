<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\Post; //to use post model
use DB;
class PagesController extends Controller
{
     public function index(){
        //$posts = Post::all();
        //$posts = Post::take(5)->get();
        //$posts= DB::select('select * from posts');
        $posts=Post::orderBy('id','desc')->paginate(5);//here we read from model we can also read from db
        $count=Post::count();
        return view('posts.index',compact('posts','count'));
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        return view('pages.services',['title'=>"Welcome To Service Page",'services'=>['Programming', 'Automation', 'Web Design']]);
    }
}
