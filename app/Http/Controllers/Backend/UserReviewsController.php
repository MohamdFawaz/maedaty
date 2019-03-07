<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order\Order;
use App\Models\ORderStatus\OrderStatus;
use App\Models\SubCategory\SubCategory;
use App\Models\UserReview\UserReview;
use App\Repositories\Order\OrderRepository;
use App\Repositories\PushNotification\NotificationRepository;
use App\Repositories\UserReview\UserReviewRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserReviewsController extends Controller
{

    protected $repository;

    public function __construct(UserReviewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        if(Auth::user()->hasRole('Super Admin')) {
            $userReviews = $this->repository->getAll();
        }elseif(Auth::user()->hasRole('Store Admin')){
            $userReviews = $this->repository->  getStoreReviewAll();
        }
        return view('backend.pages.user_review.index',compact('userReviews'));
    }


    public function destroy($review_id){
        UserReview::where('id',$review_id)->delete();
        return redirect('admin/review');
    }



}
