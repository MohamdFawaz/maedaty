<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Setting\UpdateSettingRequest;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Shop\ShopRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{

    protected $repository;

    public function __construct(ShopRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $shops = $this->repository->getAll();
        return view('backend.pages.shop.index',compact('shops'));
    }


    public function show($shop_id){
        $shop = $this->repository->getShopById($shop_id);
        return view('backend.pages.shop.show',compact('shop'));
    }

    public function edit($setting_id){
        $setting= $this->repository->getAll();
        $points_rules = json_decode($setting->points);
        return view('backend.pages.setting.edit',compact('setting','points_rules'));
    }

    public function update(UpdateSettingRequest $request){
        $rules = ['range' => $request->range,'amount' => $request->amount];
        $this->repository->updateSettings($request->except('_method','_token','range','amount'),$rules);
        return redirect('admin/settings/1/edit');
    }

    public function destroy($sug_id){
        Suggestion::where('id',$sug_id)->delete();
        return redirect('admin/suggestion');
    }



}
