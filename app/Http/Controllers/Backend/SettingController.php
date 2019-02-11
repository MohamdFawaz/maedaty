<?php

namespace App\Http\Controllers\Backend;

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
        return view('backend.pages.setting.edit',compact('setting'));
    }


    public function show($sug_id){
        $suggestion = Suggestion::where('id',$sug_id)->first();
        return view('backend.pages.suggestion.show',compact('suggestion'));
    }

    public function destroy($sug_id){
        Suggestion::where('id',$sug_id)->delete();
        return redirect('admin/suggestion');
    }



}
