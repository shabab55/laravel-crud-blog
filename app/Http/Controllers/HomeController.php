<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function PasswordChange(){
        return view('auth.password_change');
    }

    public function UpdatePass(Request $request){
        $password=Auth::user()->password;
        $oldpass=$request->oldpass;

        if(Hash::check($oldpass,$password)){
            $user=User::find(Auth::id());
            $user->password=Hash::make($request->password);

            $user->save();
            Auth::logout();

            if ($user->save()) {
                $notification=array(
                'messege'=>'Your Password Change Successfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->route('login')->with($notification);
            }else{
                $notification=array(
                'messege'=>'Password Not Matched!',
                'alert-type'=>'danger'
                 );
               return Redirect()->back()->with($notification);
            }

        }else{
            return redirect()->back();
        }
        //print_r($password);
    }
}
