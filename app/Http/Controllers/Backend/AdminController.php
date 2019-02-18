<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\AdminUser\StoreAdminUserRequest;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $users = $this->repository->getAdminAll();
        return view('backend.pages.admin.index',compact('users'));
    }

    public function show($user_id){
        $user = $this->repository->getUserByID($user_id);
        return view('backend.pages.user.show',compact('user'));
    }

    public function edit($user_id){
        $user = $this->repository->getUserByID($user_id);
        return view('backend.pages.admin.edit',compact('user'));
    }

    public function create(){
        return view('backend.pages.admin.create');
    }

    public function store(StoreAdminUserRequest $request){
        $this->repository->createAdminAccount($request->except('_token','_method'));
        return redirect('admin/admin_users');
    }

    public function update($user_id,Request $request){
        $user = $this->repository->updateUser($user_id,$request->all());
        return redirect('admin/admin_users');
    }


    public function delete($user_id){
        $user = $this->repository->destroyUser($user_id);
        return redirect('admin/admin_users');
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
