<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\UserFavorite\StoreFavoriteRequest;
use App\Models\Shop\Shop;
use App\Models\Shop\ShopBranches;
use App\Models\UserReview\UserReview;
use App\Repositories\Shop\ShopRepository;
use App\Repositories\UserReview\UserReviewRepository;
use Illuminate\Http\Request;
use App\Http\Requests\UserReview\StoreReviewRequest;

class ShopController extends APIController
{

    protected $repository;


    public function __construct(Request $request, ShopRepository $repository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->repository = $repository;

    }

    public function index(){
        $result = Shop::with('shop_branches')->status()->notOwner()->get();
        $data = $this->repository->getShopDetails($result);
        return $this->respond(
            200,
            trans('messages.shop.list'),
            $data
        );
    }

    public function shopBranches($shop_id){
        $shop_branches = ShopBranches::where('shop_id',$shop_id)->get();
        $branches_list = $this->repository->getShopBranches($shop_branches);
        return $this->respond(
            200,
            trans('messages.shop.branches'),
            $branches_list
        );
    }

    public function getShopCategories($shop_id){
        $data = $this->repository->getShopCategories($shop_id);
        return $this->respond(200,trans('messages.shop.category'),$data);
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
