<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserAuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function create(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
        ]);

        //if form is validated successfully, then register new user
        // $user = User::create([
        //     'name'=> $request['name'],
        //     'email'=>$request['email'],
        //     'password'=>Hash::make($request['password']),
        // ]);

        //USE QUERY BUILDER
        $user = DB::table('users')
                ->insert([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password)
                ]);

        if($user){
            return back()->with('success', 'You have been successfully registered');
        }else{
            return back()->with('fail', 'Bad Credentials');
        }

    }

    public function check(Request $request) {
        //validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //if form is validated successfully, then process login
        // $user = User::where('email', '=', $request->email)->first();
        $user = DB::table('users')
                ->where('email', $request->email)
                ->first();

        if($user){
            if(Hash::check($request->password, $user->password)){

                //if password match, then store to session and redirect to profile page
                $request->session()->put('LoggedUser', $user->id);
                return redirect('profile');
            }else{
                return back()->with('fail', 'Invalid password');
            }
        }else{
            return back()->with('fail', 'No account found for this email');
        }
    }

    public function profile(){
        if(session()->has('LoggedUser')){
            // $user = User::where('id', '=', session('LoggedUser'))->first();
            $user = DB::table('users')
                    ->where('id', session('LoggedUser'))
                    ->first();
            $data = [
                'LoggedUserInfo' => $user
            ];
        }
        return view('admin.profile', $data);
    }

    public function logout() {
        if(session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }
}
