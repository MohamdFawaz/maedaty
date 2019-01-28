<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Setting\SettingRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credential = array('email'=> $request->email, 'password' => $request->password);
        if($user = Auth::attempt($credential)){
            return redirect('message');
        }else{
            return redirect('login');
        }
    }


}
