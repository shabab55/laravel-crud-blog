<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
	        'title' => 'required|unique:posts|max:255',
	        'description' => 'required',
	        'tag' => 'required',
	        'author' => 'required|min:4|max:40',
         ]);

         $post =new Post;
         $post->title=$request->title;
         $post->author=$request->author;
         $post->tag=$request->tag;
         $post->description=$request->description;
         $result=$post->save();

        if ($result) {
            $notification=array(
                'messege'=>'Post Added Successfully',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }else{
            return Redirect()->back();
        }

    }

    public function AllPost(){
        //echo "all post here";
        $post=Post::all();
        return view('all_post')->with('post',$post);
    }

    public function Delete($id){
        //echo "$id";
        $post=Post::find($id);
        $postDelete=$post->delete();

        if ($postDelete) {
            $notification=array(
                'messege'=>'Post Delete Successfully',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }else{
            return Redirect()->back();
        }
    }

    public function Edit($id){
        $post=Post::findorfail($id);
        return view('editpost',compact('post',$post));
    }

    public function Update(Request $request,$id){
        $validatedData = $request->validate([
	        'title' => 'required|max:255',
	        'description' => 'required',
	        'tag' => 'required',
	        'author' => 'required|min:4|max:40',
         ]);

         $post= Post::findorfail($id);
         $post->title=$request->title;
         $post->author=$request->author;
         $post->tag=$request->tag;
         $post->description=$request->description;
         $update=$post->save();

        if ($update) {
            $notification=array(
                'messege'=>'Update Successfully',
                'alert-type'=>'info'
                );
            return Redirect()->route('home')->with($notification);
        }else{
            return Redirect()->back();
        }
    }

    public function News(){
        return view('news_add');
    }

    public function InsertNews(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'details' => 'required',
            'image' => 'required',
            'author' => 'required|min:4|max:40',
           ]);
        $data=array();
        $data['title']=$request->title;
        $data['details']=$request->details; //strpos to aviod html tag to enter database
        $data['author']=$request->author;

        $image=$request->image;

        if ($image) {
            $image_name=str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/post/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
               $data['image']=$image_url;
               $news=DB::table('news')->insert($data);
              if ($news) {
                     $notification=array(
                     'messege'=>'Post Inserted Successfully',
                     'alert-type'=>'success'
                      );
                    return Redirect()->route('news.add')->with($notification);
                 }else{
                   return Redirect()->back();
                 }
            }
         }else{
           return Redirect()->back();
          }
    }

    public function AllNews(){
        $allnews=DB::table('news')->get();
        return view('all_news')->with('allnews',$allnews);
    }

    public function DeleteNews($id){
        $img=DB::table('news')->where('id',$id)->first();
        $image_path=$img->image;
        $done=unlink($image_path);
        
        $deleteNews =DB::table('news')->where('id',$id)->delete();

        if ($deleteNews) {
            $notification=array(
            'messege'=>'News Deleted Successfully',
            'alert-type'=>'success'
             );
            return redirect()->route('all.news')->with($notification);
        }else{
          return Redirect()->back();
        }

    }
}
