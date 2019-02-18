<?php

namespace App\Http\Controllers\Backend;

use App\Models\User\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $users = $this->repository->getAll();
        return view('backend.pages.user.index',compact('users'));
    }

    public function show($user_id){
        $user = $this->repository->getUserByID($user_id);
        return view('backend.pages.user.show',compact('user'));
    }

    public function updateStatus(Request $request){
        $user = User::whereId($request->user_id)->first();
        $user->status = $request->status;
        $user->save();
        $result = array(
            'success' => true,
            'status' => $user->status
        );
        return response()->json($result,200);
    }



}
