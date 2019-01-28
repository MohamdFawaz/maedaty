<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Setting\SettingRepository;

class AboutUsController extends Controller
{
    protected $repository;


    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index(){
        $about = $this->repository->getSettingByKey('about_us');
        return view('frontend.pages.about',compact('about'));
    }
}
