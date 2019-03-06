<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class NewsController extends Controller
{
    
    public function SingleNewsView($id){
        $singleNews=DB::table('news')->where('id',$id)->first();
        return view('single_news')->with('singleNews',$singleNews);
    }
}
