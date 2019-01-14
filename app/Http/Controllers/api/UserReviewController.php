<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\UserFavorite\StoreFavoriteRequest;
use App\Models\UserReview\UserReview;
use App\Repositories\UserReview\UserReviewRepository;
use Illuminate\Http\Request;
use App\Models\Address\UserFavorite;
use App\Http\Requests\UserReview\StoreReviewRequest;

class UserReviewController extends APIController
{

    protected $repository;


    public function __construct(Request $request, UserReviewRepository $repository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->repository = $repository;

    }

    public function store(StoreReviewRequest $request){
        $review = $request->only(['user_id','product_id','rate_value','comment']);
        if($this->repository->create($review)){
            return $this->respondWithMessage(trans('messages.review.added'));
        }else{
            $this->respondWithError(trans('messages.something_went_wrong'));
        }
    }

}
