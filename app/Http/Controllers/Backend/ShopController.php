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

class ShopController extends Controller
{

    protected $repository;
    protected $userRepository;

    public function __construct(ShopRepository $repository,UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function index(){
        $shops = $this->repository->getAll();
        return view('backend.pages.shop.index',compact('shops'));
    }

    public function create(){

        $users = $this->userRepository->getAll();
        return view('backend.pages.shop.create',compact('users'));
    }

    public function store(StoreShopRequest $request){
        $shop = $this->repository->create($request->all());
        return redirect('admin/shop');
    }



    public function show($shop_id){
        $shop = $this->repository->getShopById($shop_id);

        return view('backend.pages.shop.show',compact('shop'));
    }

    public function edit($shop_id){
        $shop = $this->repository->getShopById($shop_id);
        $users = $this->userRepository->getAll();
        return view('backend.pages.shop.edit',compact('shop','users'));
    }

    public function update($shop_id,UpdateShopRequest $request){
        $this->repository->update($shop_id,$request->all());
        return redirect('admin/shop');
    }

    public function destroy($shop_id){
        $this->repository->delete($shop_id);
        return redirect('admin/shop');
    }

    public function updateStatus(Request $request){
        $shop = Shop::whereId($request->shop_id)->first();
        $shop->status = $request->status;
        $shop->save();
        $result = array(
            'success' => true,
            'status' => $shop->status
        );
        return response()->json($result,200);
    }



}
