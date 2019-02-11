<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order\Order;
use App\Models\ORderStatus\OrderStatus;
use App\Models\SubCategory\SubCategory;
use App\Models\Suggestion\Suggestion;
use App\Models\UserReview\UserReview;
use App\Repositories\Order\OrderRepository;
use App\Repositories\PushNotification\NotificationRepository;
use App\Repositories\Suggestion\SuggestionRepository;
use App\Repositories\UserReview\UserReviewRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuggestionController extends Controller
{

    protected $repository;

    public function __construct(SuggestionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $suggestions = $this->repository->getAll();
        return view('backend.pages.suggestion.index',compact('suggestions'));
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
