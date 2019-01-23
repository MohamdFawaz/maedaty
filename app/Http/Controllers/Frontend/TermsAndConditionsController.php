<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Setting\Setting;
use App\Repositories\Setting\SettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsAndConditionsController extends Controller
{
    protected $repository;


    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $terms = $this->repository->getSettingByKey('terms_and_conditions');
        return view('frontend.pages.terms',compact('terms'));
    }
}
