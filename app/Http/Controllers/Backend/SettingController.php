<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Setting\UpdateSettingRequest;
use App\Repositories\Setting\SettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    protected $repository;

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $setting = $this->repository->getAll();
        return view('backend.pages.setting.index',compact('setting'));
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
