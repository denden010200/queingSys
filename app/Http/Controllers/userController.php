<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class userController extends Controller
{

    public function addUser(Request $req)
    {
        $name = $req->input('name');
        $email = $req->input('typeemail');
        $password = md5($req->input('typepassword'));
        $data = array('name' => $name, 'email' => $email, 'password' => $password);
        DB::table('users')->insert($data);

        return redirect()->back()->withErrors('message', "You have successfully registered!");

    }

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        Session::flush();
        return redirect('login');
    }

    public function loginUser(Request $req)
    {
        $email = $req->input('email');
        $password = md5($req->input('password'));
        if (
            DB::table('users')
            ->where('email', '=', $email)
            ->where('password', '=', $password)
            ->exists()
        ) {
            $id = DB::table('users')
                ->where('email', '=', $email)
                ->where('password', '=', $password)
                ->get();
            $user_id = 0;
            $name = '';

            foreach ($id as $uid) {
                $user_id = $uid->id;
                $name = $uid->name;
            }

            Session::put('user_id', $user_id);
            Session::put('name', $name);
            return redirect('home');

        } else {
            return redirect()->back()->with('message', "Incorrect email or password.");
        }

    }
}
