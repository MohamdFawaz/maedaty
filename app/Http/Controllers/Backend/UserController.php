<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Setting\UpdateSettingRequest;
use App\Http\Requests\Backend\Shop\StoreShopRequest;
use App\Http\Requests\Backend\Shop\UpdateShopRequest;
use App\Models\Shop\Shop;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Shop\ShopRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store;

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
